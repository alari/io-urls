package io.urls

import org.apache.commons.lang.RandomStringUtils

class Link {

    static final String SHORT_KEY_MATCHER = /^[-_a-zA-Z0-9]{1,16}$/

    String fullUrl
    String shortKey

    Date dateCreated

    static belongsTo = [user: User, folder: Folder]
    static hasMany = [clicks: Click]

    static constraints = {
        shortKey unique: true, maxSize: 16, minSize: 1, matches: SHORT_KEY_MATCHER
        fullUrl url: true, maxSize: 512
        folder nullable: true
        user nullable: true
    }

    def beforeValidate() {
        if (!shortKey) {
            shortKey = RandomStringUtils.randomAlphanumeric(5)
            while (Link.countByShortKey(shortKey)) shortKey = RandomStringUtils.randomAlphanumeric(5)
        }
        if (!id) {
            try {
                fullUrl = new URL(new URI(fullUrl.trim().replace(" ", "%20")).toASCIIString()).toString()
            } catch (Exception e) {
                return false
            }
        }
    }

    String getShortUrl() {
        "http://urls.io/${shortKey}"
    }
}
