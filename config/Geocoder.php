<?php
const CONFIG = [

"API_TOKEN" => "AIzaSyDRHqQl5jVDSwvGp1d569VAbeHA8PIhEF8"





];

function config($param = null)
{
	return CONFIG[$param]?? null;
}

