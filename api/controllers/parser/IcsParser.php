<?php

	namespace controllers\parser;
	use \models\Place;


class IcsParser {

    protected $proid = "Lolimac Events//Lolimac//FR";
	public $ics;

    public function __construct() {
		$this->ics = "BEGIN:VCALENDAR\r
METHOD:PUBLISH\r
VERSION:2.0\r
PRODID:-//{$this->proid}\r\n";
    }

    public function openEvent() {
		$this->ics .= "BEGIN:VEVENT\r\n";
    }
    public function closeEvent() {
		$this->ics .= "END:VEVENT\r\n";
    }

	public function setDate_timeStamp() {
		$date = new \DateTime("now");
		$this->ics .= "DTSTAMP:{$date->format('Ymd\THis\Z')}\r\n";
	}
	public function setDate_start($date) {
		$date = new \DateTime($date);
		$this->ics .= "DTSTART:{$date->format('Ymd\THis\Z')}\r\n";
	}


	public function setDate_end($date) {
		$date = new \DateTime($date);
		$this->ics .= "DTEND:{$date->format('Ymd\THis\Z')}\r\n";
	}
	public function setStatus() {
		$this->ics .= "STATUS:CONFIRMED\r\n";
	}

	public function setLocation(Place $place) {
		if ($place->getName()) {
			$this->ics .= "LOCATION:{$place->getName()} {$place->getCity()} {$place->getPostcode()} {$place->getStreet()} {$place->getNumber()}\r\n";
		}
	}

	public function setUID($id) {
		$id = md5($id);
		$this->ics .= "UID:$id\r\n";
	}

	public function setSUMMARY($name) {
		$this->ics .= "SUMMARY:$name\r\n";
	}

	public function closeCalendar() {
		$this->ics .= "END:VCALENDAR\r\n";
	}

}
