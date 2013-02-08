package old

class OldUsers {

	Integer role
	String identity
	String pwdHash
	String email
	String nickname
	String apiKey

	static mapping = {
		version false
        datasource "old"
        table "users"
	}

	static constraints = {
		role nullable: true
		identity nullable: true, maxSize: 64, unique: true
		pwdHash nullable: true, maxSize: 32
		email nullable: true, unique: true
		nickname nullable: true
		apiKey nullable: true, maxSize: 32, unique: true
	}
}
