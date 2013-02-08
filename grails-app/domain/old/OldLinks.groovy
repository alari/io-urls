package old

class OldLinks {

	String fullUrl
	String shortKey
	Integer owner
	Integer env
	Integer statsCount

	static mapping = {
		version false
        datasource "old"
        table "links"
	}

	static constraints = {
		shortKey maxSize: 16, unique: true
		owner nullable: true
		env nullable: true
	}
}
