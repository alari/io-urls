package old

class OldStats {

	Integer link
	Integer time
	String remoteAddr
	String refererHost
	String refererPath

	static mapping = {
		version false
        datasource "old"
        table "link_stats"
	}

	static constraints = {
		link nullable: true
		time nullable: true
		remoteAddr nullable: true, maxSize: 64
		refererHost nullable: true, maxSize: 32
		refererPath nullable: true, maxSize: 64
	}
}
