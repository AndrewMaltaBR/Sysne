function setSession(json) {
	window.localStorage.setItem('session',json);
}

function getSession() {
	var data = null;
	data = window.localStorage.getItem("session");
	if(data != null)
		data = JSON.parse(data);
	return data;
}

function destroySession() {
	window.localStorage.removeItem("session");
}