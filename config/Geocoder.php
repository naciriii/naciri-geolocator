<?php
const CONFIG = [

"API_TOKEN" => "YOUR-GOOGLE-API-TOKEN"





];
foreach(CONFIG as $key => $val) {
	putenv($key.'='.$val);
}

function config($param = null)
{
	if(getenv($param)!= false) {
		return getenv($param);
	}
	return null;
}

