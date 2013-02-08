package old

class OldEnvs {

	Integer owner
	String title

	static mapping = {
		version false
        datasource "old"
        table "envs"
	}

	static constraints = {
		owner nullable: true
		title maxSize: 32, unique: ["owner"]
	}
}
