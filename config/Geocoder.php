<?php
const CONFIG = [

"API_TOKEN" => "YOUR-GOOGLE-API-TOKEN"





];

function config($param = null)
{
	if(getenv("API_TOKEN")!= null) {
		return getenv("API_TOKEN");
	}
	return CONFIG[$param]?? null;
}

