<?php

class ICS
{
    var $data;
    var $name;

    function __construct($start, $end, $name, $description, $location, $url)
    {
        $this->name = $name;
        $this->data = "BEGIN:VCALENDAR\nVERSION:2.0\nMETHOD:PUBLISH\nBEGIN:VEVENT\nDTSTART:" . date("Ymd\THis\Z", strtotime($start)) . "\nDTEND:" . date("Ymd\THis\Z", strtotime($end)) . "\nLOCATION:" . $location . "\nTRANSP: OPAQUE\nSEQUENCE:0\nUID:\nDTSTAMP:" . date("Ymd\THis\Z") . "\nSUMMARY:" . $name . "\nDESCRIPTION:" . $description . "\nURL;VALUE=URI:" . $url . "\nPRIORITY:1\nCLASS:PUBLIC\nEND:VEVENT\nEND:VCALENDAR\n";
    }

    function save()
    {
        //file_put_contents($this->name . ".ics", $this->data);
        return CFile::SaveFile(
            array(
                "name" => $this->name . time().'.ics',
                "content" => $this->data
            ),
            'ics'
        );
    }

    function show()
    {
        header("Content-type:text/calendar");
        header('Content-Disposition: attachment; filename="' . $this->name . '.ics"');
        Header('Content-Length: ' . strlen($this->data));
        Header('Connection: close');
        echo $this->data;
    }
}