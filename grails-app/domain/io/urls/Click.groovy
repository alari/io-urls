package io.urls

class Click {

    Date dateCreated
    String remoteAddr
    String refererHost
    String refererPath
    static belongsTo = [link: Link]

    static constraints = {
        remoteAddr blank: true, nullable: true
        refererHost blank: true, nullable: true
        refererPath blank: true, nullable: true
    }
}
