import io.urls.Link

class UrlMappings {

	static mappings = {
		"/api/get-short"(controller: "link", action: "apiGetShort")
        "/$shortKey"(controller: "link", action: "click"){
            constraints {
                shortKey matches: Link.SHORT_KEY_MATCHER
            }
        }
        "/link/$action"(controller: "link")

        "/api/docs"(view: "/apiDocs")
		"/"(view:"/index")
		"500"(view:'/error')
	}
}
