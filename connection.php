
<?php

	$conn = pg_connect("postgres://dojidxnfltrbxw:4a84324a22e824f79aec085a84814d0b00b629d6449a98d00b01f540c9ef429a@ec2-44-210-228-110.compute-1.amazonaws.com:5432/d17d1ctjt6rphd");
	
    if (!$conn) {
        die("Connection failed");
    }
?>