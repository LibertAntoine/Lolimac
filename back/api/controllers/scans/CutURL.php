<?php

	namespace controllers\scans;


class CutURL {

    protected $URL_cut;

    public function __construct($url) {
		$url_cutted = parse_url($url, PHP_URL_PATH); // NOTE: Focus on the actual path of the URL, preventing errors with query arguments
        $url_cutted = explode ("/" , $url_cutted);
        while ($url_cutted[0] != "api") {
            array_shift($url_cutted);
        }
		array_shift($url_cutted);
        $this->URL_cut = $url_cutted;
    }

    public function getURL_cut() {
        return $this->URL_cut;
    }


}
