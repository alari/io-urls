package io.urls

class Folder {

    String title

    static belongsTo = [user: User]
    static hasMany = [links: Link]

    Date dateCreated

    static constraints = {
        title maxSize: 32, unique: ["user"]
    }
}
