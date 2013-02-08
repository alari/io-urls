package io.urls

import io.urls.shiro.ShiroUser
import org.apache.commons.lang.RandomStringUtils

class User extends ShiroUser {

    String email
    String apiKey
    Date dateCreated

    static hasMany = [
            links: Link,
            folders: Folder
    ]

    static constraints = {
        apiKey unique: true, size: 32..32
        email email: true, unique: true, blank: true, nullable: true
        username unique: true
    }

    def beforeValidate() {
        if (!apiKey) {
            apiKey = RandomStringUtils.randomAlphanumeric(32)
            while (Link.countByShortKey(apiKey)) apiKey = RandomStringUtils.randomAlphanumeric(32)
        }
    }
}
