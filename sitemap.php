<?php
   	header("Content-Type: application/xml; charset=utf-8");
    $sm = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';  
	$add ="http://www.ir2020.ir.com/" ;
	$date = date("Y-m-d");	

	$sm .="
	<url>
	  <loc>http://www.ir2020.ir.com/</loc>
	</url>
	<url>
	  <loc>http://www.ir2020.ir.com/aboutus.html</loc>
	</url>
	<url>
	  <loc>http://www.ir2020.ir.com/contact.html</loc>
	</url>
	<url>
	  <loc>http://www.ir2020.ir.com/price.html</loc>
	  <lastmod>{$date}</lastmod>
	  <changefreq>daily</changefreq>
	  <priority>0.8</priority>
	</url>
";
	
    $sm.= "</urlset>";
	echo $sm;