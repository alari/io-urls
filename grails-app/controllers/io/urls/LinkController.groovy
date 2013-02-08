package io.urls

import grails.converters.JSON
import org.grails.datastore.mapping.validation.ValidationException

class LinkController {

    def apiGetShort(String api_key, int env, String full_url, String short_key) {
        User user = api_key ? User.findByApiKey(api_key) : null
        Folder folder = env ? Folder.findByUserAndId(user, env) : null

        Link link = new Link(user: user, folder: folder, fullUrl: full_url, shortKey: short_key)
        try {
            link.save(failOnError: true)
            render([status: "SUCCEED", short_url: link.shortUrl, short_key: link.shortKey] as JSON)
        } catch (ValidationException e) {
            render([status: "FAILED", error_msg: e.message] as JSON)
        }

    }

    def click(String shortKey) {
        Link link = Link.findByShortKey(shortKey)
        if (!link) {
            redirect url: "/"
            return
        }
        redirect url: link.fullUrl
        URL referer
        try {
            referer = new URL(request.getHeader("Referer"))
        } catch (Exception e) {}

        new Click(
                link: link,
                remoteAddr: request.remoteAddr,
                refererHost: referer?.host,
                refererPath: referer?.path
        ).save()
    }

    def create(String fullUrl, String shortKey) {
        Link link = new Link(fullUrl: fullUrl, shortKey: shortKey)
        try {
            link.save(failOnError: true)
            render """
<div id="attention">
<h4>Resulting URL: <a href="${link.shortUrl}" target="_blank">${link.shortUrl}</a></h4>
</div>
"""
        } catch (ValidationException e) {
            render e.message
        }
    }
}
