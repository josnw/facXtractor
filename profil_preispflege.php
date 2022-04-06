<?php 
 $sql = "select distinct a.arnr, abz1, abz2, abst, asco,asrt, a.apjs, a.ameh, l.linr, a.linr as HLINR, absp, absg, p1.AKLK as AKL1, p6.AKLK as AKL6, 
	 current_date as qvon, '9999-12-31' as qbis, '' as cprs, 1 as qexp, cprs as ALT, m.ARGV, (select avg(AEKD) from art_best ab where ab.arnr = a.arnr and ab.amge > 0) as AEKD, 
	 a.quse, qmc4 
	from art_lief l 
	left join art_txt t on l.arnr = t.arnr
	left join art_0 a on a.arnr = l.arnr 
	left join art_matrix m on m.arnr = l.arnr and m.xxak = '' and m.xyak = ''
	left join art_matrixprs p1 on p1.arnr = l.arnr and p1.xxak = '' and p1.xyak = '' and p1.mprb = 1
	left join art_matrixprs p6 on p6.arnr = l.arnr and p6.xxak = '' and p6.xyak = '' and p6.mprb = 6
	left join art_ean e on l.arnr = e.arnr and asco like '4%'
	left join cond_ek c on c.arnr = l.arnr and c.xxak = '' and c.xyak = '' and cpog = 'F000' and qvon < current_date and qbis > current_date and cbez = 'FPNE' and (c.qskz is null or c.qskz = 0) and c.linr = l.linr
	where l.linr  = :linr and l.xxak = '' and l.xyak = '' and l.obnr = 0
	and (quse is null or quse < 2)
	and a.linr <> 999999 and a.qgrp < 900
	group by a.arnr, l.xxak, l.xyak, abz1, abz2, abst, asco, asrt, a.apjs, a.ameh, l.linr, a.linr  , absp, absg, p1.AKLK  , p6.AKLK  , 
	  cprs , m.ARGV,   a.quse 
	order by a.arnr
	";
 $header = [
  'Artikel',
  'Bez1',
  'Bez2',
  'Bestellnr',
  'EAN',
  'Sortiment',
  'PE',
  'ME',
  'Lieferant',
  'Hauptlief.',
  'BestellSperre',
  'BSGrund',
  'Kalk01',
  'Kalk06',
  'Preis von',
  'Preis bis',
  'NettoEK NEU',
  'ExpKZ',
  'NettoEK alt',
  'RabattGruppe',
  'Durchschn.EK',
  'VerwendungsKZ',
  'LiefUmrPL'		
 ];
 
 $splitField = 'linr';
 $parameter = [
	'linr' => $_GET['linr']
 ];

 $outputFilePrefix = "./Preispflege.csv";
 
 ?>