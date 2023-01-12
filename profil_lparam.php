 <?php 
 $sql = "select a.arnr, e.asco, abz1, abz2, abz3, a.agew, a.linr, l.qsbz as lqsbz, a.qgrp, a.ameh,
    case when a.amgn <> 0 then a.amgz / a.amgn else 1 end, 
			a.ageh, vk.agew vkgew, vk.amsx vkamsx, vk.amsy vkamsy, vk.amsz vkamsz, vk.amsd as vkamsd, null as vs , null as gg, alpf,
			ek.ageh ekageh, case when ek.qune <> 0 then ek.quzl / ek.qune else 1 end ekumr, 
			ek.agew ekgew, ek.amsx amsx, ek.amsy ekamsy, ek.amsz ekamsz, ek.amsd ekamsd
			from art_0 a inner join art_txt using (arnr)
				left join art_umrechn vk on a.arnr = vk.arnr and a.ageh = vk.ageh and (a.linr = vk.linr or vk.linr is null)
				left join art_umrechn ek on a.arnr = ek.arnr and ek.ageh = 'Pal' and (a.linr = ek.linr or ek.linr = 0)
				left join art_best b on a.arnr = b.arnr || b.xxak || b.xyak
				left join art_ean e on a.arnr = e.arnr and e.qskz = 1
				left join lif_0 l on a.linr = l.linr
				left join art_lief al on a.linr = al.linr and a.arnr = al.arnr || al.xxak || al.xyak and al.obnr = 0
				left join art_matrixfil mf on a.arnr = mf.arnr || mf.xxak || mf.xyak
			where amge > 0 and b.ifnr = 1
			group by a.arnr, e.asco, abz1, abz2, abz3, a.agew, a.amsx, a.amsy, a.amsz,
				 a.linr, l.qsbz , a.qgrp, a.ageh, ek.ageh, ek.quzl, ek.qune,
				 vk.agew, vk.amsx, vk.amsy, vk.amsz,vk.amsd, alpf, 
				 ek.agew, ek.amsx, ek.amsy, ek.amsz,ek.amsd
			order by linr, abz1 
 ";
 $header = [
  'Artikel',
  'EAN',
  'Bez1',
  'Bez2',
  'Bez3',
  'Gewicht ME (kg)',
  'Lieferant',
  'Lief.Name',
  'Gruppe',
  'BasisME',
  'GebMenge',
  'VK-Gebinde',
  'VKG Gewicht (kg)',
  'VKG Länge',
  'VKG Breite',
  'VKG Höhe',
  'VKG Durchmesser',
  'versandfähig(B|P|S)',
  'Gefahrgut/InfoDaten',
  'PickPlatz',
  'EK-Gebinde',
  'EK-Umrechnung',
  'EKG Gewicht (kg)',
  'EKG Länge',
  'EKG Breite',
  'EKG Höhe',
  'EKG Durchmesser',
  'Gitterost (X)',
  'Windlastgefährdet(X)',
  'Rieselschutz(X)',
  'Frostschutz(X)',
  'Witterungsgeschützt(X)',
  'Hallenlagerung(X)',
  'Stabelbar (Gesamtzahl)',
  'Palette drehbar(X)'
 ];
 
 $splitField = 'lqsbz';
 $parameter = null;

 $outputFilePrefix = "./Artikelparameter.csv";
 
 $createType = "w";
 
 ?>