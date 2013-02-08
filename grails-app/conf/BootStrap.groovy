import io.urls.Click
import io.urls.Folder
import io.urls.Link
import io.urls.User
import old.OldEnvs
import old.OldLinks
import old.OldStats
import old.OldUsers

class BootStrap {

    def init = { servletContext ->
       /* Map<Integer, User> userMap = [:]
        Map<Integer, Folder> folderMap = [:]
        Map<Integer, Link> linkMap = [:]

        Set<String> ignoreDomains = ["sexmomvideo.com", "oficinadapessoa.com", "vagabundohitech.xpg.com.br", "t35.com", "tennesseeboutique.com",
                "servik.com", "servik.net", "atspace.biz", "atspace.net", "atspace.us", "22web.net", "wetpaint.com", "totalh.com", "10001mb.com", "playspidermangames.net",
                "atspace.org", "multimania.de", "talk4fun.net", "atspace.com", "isgreat.org", "multimania.co.uk", "multimania.nl", "edublogs.org", "svt.se", "mir.io",
        "my3gb.com", "66ghz.com", "atspace.name", "2kool4u.net", "iblogger.org", "gofreeserve.com", "owlparty.org", "sexpantyhosevideo.com", "flashgamesgalore.info"]
        Set<String> ignoreInPath = ["wp-admin/", "sex", "wp-includes", "wp-content", "dating", "account/", "date/index.php?page="]

        OldUsers.all.each { OldUsers ou ->
            User u = User.findOrSaveWhere(apiKey: ou.apiKey,
                    username: ou.nickname,
                    passwordHash: '',
                    email: ou.email)
            u.save(flush: true, failOnError: true)
            println ou.id
            userMap.put(ou.id.toInteger(), u)
        }
        println "users parsed"

        OldEnvs.all.each { OldEnvs oe ->
            Folder f = new Folder()
            f.title = oe.title
            assert userMap.get(oe.owner).id
            f.user = userMap.get(oe.owner)
            f.save(flush: true, failOnError: true)
            println oe.id
            folderMap.put(oe.id.toInteger(), f)
        }
        println "folders parsed"

        for (OldLinks ol in OldLinks.all) {
            try {
                URI u = new URI(ol.fullUrl.trim().replace(" ", "%20"))
                if (ignoreDomains.any { u.host.endsWith(it) }) continue;
                if (ignoreInPath.any { u.path.contains(it) }) continue;
                if (ol.statsCount == 0 && !ol.owner) {
                    println "${ol.id} No stats: ${ol.fullUrl}"
                    continue
                }
                HttpURLConnection con =
                    (HttpURLConnection) u.toURL().openConnection()
                con.setRequestMethod("HEAD");
                if(con.getResponseCode() != HttpURLConnection.HTTP_OK) {
                    continue
                }
            } catch (Exception e) {
                println "${ol.id} Failed at the beginning: " + ol.fullUrl
                println e.message
                continue
            }


            Link l = new Link()
            l.fullUrl = ol.fullUrl
            l.shortKey = ol.shortKey
            l.folder = folderMap.get(ol.env)
            l.user = userMap.get(ol.owner)
            if (l.validate()) {
                try {
                    l.save(flush: true, failOnError: true)
                    linkMap.put(ol.id.toInteger(), l)
                } catch (Exception e) {
                    println "${ol.id} End: " + l.fullUrl
                    throw e
                }
            } else {
                println "${ol.id} Errors:" + l.errors
            }
        }
        println "links parsed (${linkMap.size()})"

        OldStats.all.each { OldStats os ->
            if(!linkMap.containsKey(os.link)) return;
            new Click(link: linkMap.get(os.link),
            refererHost: os.refererHost,
                    refererPath: os.refererPath,
                    remoteAddr: os.remoteAddr
            ).save(flush: true)
        }
        println "stats parsed"*/
    }
    def destroy = {
    }
}
