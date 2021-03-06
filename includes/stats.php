<?php
	include "includes/query.php";
	include "includes/svtime.php";
	
	echo $avgsurv_lng.': '.stime($crosssurvival["avg(survival_time)"]);
	
	echo '<br />
			<table border="0" align="center">
				<tr class="tr_1">
					<td>#</td>
					<td><a href="?type=name&order='.$sort.'">'.($type == "name" ? $name_lng.'<img src="images/'.$order.'.png" title="'.$asc.'" />' : $name_lng.'<img src="images/noorder.png" title="" alt="">').'</a></td>
					<td><a href="?type=humanity&order='.$sort.'">'.($type == "humanity" ? $humanity_lng.'<img src="images/'.$order.'.png" title="'.$asc.'" />' : $humanity_lng.'<img src="images/noorder.png" title="" alt="">').'</a></td>
					<td><a href="?type=life&order='.$sort.'">'.($type == "life" ? $life_lng.'<img src="images/'.$order.'.png" title="'.$asc.'" />' : $life_lng.'<img src="images/noorder.png" title="" alt="">').'</a></td>
					<td><a href="?type=svtime&order='.$sort.'">'.($type == "svtime" ? $svtime_lng.'<img src="images/'.$order.'.png" title="'.$asc.'" />' : $svtime_lng.'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=tsvtime&order='.$sort.'">'.($type == "tsvtime" ? $total_lng.'<img src="images/'.$order.'s.png" title="'.$asc.'" />' : $total_lng.'<img src="images/noorders.png" title="" alt="">').'</a></td>
					<td><a href="?type=kills&order='.$sort.'">'.($type == "kills" ? $kills_lng.'<img src="images/'.$order.'.png" title="'.$asc.'" />' : $kills_lng.'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=tkills&order='.$sort.'">'.($type == "tkills" ? $total_lng.'<img src="images/'.$order.'s.png" title="'.$asc.'" />' : $total_lng.'<img src="images/noorders.png" title="" alt="">').'</a></td>
					<td><a href="?type=bkills&order='.$sort.'">'.($type == "bkills" ? $bkills_lng.'<img src="images/'.$order.'.png" title="'.$asc.'" />' : $bkills_lng.'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=tbkills&order='.$sort.'">'.($type == "tbkills" ? $total_lng.'<img src="images/'.$order.'s.png" title="'.$asc.'" />' : $total_lng.'<img src="images/noorders.png" title="" alt="">').'</a></td>
					<td><a href="?type=zkills&order='.$sort.'">'.($type == "zkills" ? $zkills_lng.'<img src="images/'.$order.'.png" title="'.$asc.'" />' : $zkills_lng.'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=tzkills&order='.$sort.'">'.($type == "tzkills" ? $total_lng.'<img src="images/'.$order.'s.png" title="'.$asc.'" />' : $total_lng.'<img src="images/noorders.png" title="" alt="">').'</a></td>
					<td><a href="?type=hs&order='.$sort.'">'.($type == "hs" ? $hs_lng.'<img src="images/'.$order.'.png" title="'.$asc.'" />' : $hs_lng.'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=ths&order='.$sort.'">'.($type == "ths" ? $total_lng.'<img src="images/'.$order.'s.png" title="'.$asc.'" />' : $total_lng.'<img src="images/noorders.png" title="" alt="">').'</a></td>
					<td><a href="?type=hsq&order='.$sort.'">'.($type == "hsq" ? $hsq_lng.'<img src="images/'.$order.'.png" title="'.$asc.'" />' : $hsq_lng.'<img src="images/noorder.png" title="" alt="">').'</a><br /><font size="1"><a href="?type=thsq&order='.$sort.'">'.($type == "thsq" ? $total_lng.'<img src="images/'.$order.'s.png" title="'.$asc.'" />' : $total_lng.'<img src="images/noorders.png" title="" alt="">').'</a></td>
				</tr>';

	while ($row = mysql_fetch_array($stats))
	{
		$stat_name = $row['name'];
		$stat_humanity = $row['humanity'];
		$stat_life = $row['survival_attempts'] - 1;
		$stat_svtime = sprintf('%d day%s %02d hour%s %02d minute%s', $row['survival_time'] / 1440, floor($row['survival_time'] / 1440) != 1 ? 's' : '', $row['survival_time'] / 60 % 24, floor($row['survival_time'] / 60 % 24) != 1 ? 's' : '', $row['survival_time'] % 60, floor($row['survival_time'] % 60) != 1 ? 's' : '');
		$stat_tsvtime = sprintf('%d day%s %02d hour%s %02d minute%s', ($row['survival_time'] + $row['total_survival_time']) / 1440, floor(($row['survival_time'] + $row['total_survival_time']) / 1440) != 1 ? 's' : '', ($row['survival_time'] + $row['total_survival_time']) / 60 % 24, floor(($row['survival_time'] + $row['total_survival_time']) / 60 % 24) != 1 ? 's' : '', ($row['survival_time'] + $row['total_survival_time']) % 60, floor(($row['survival_time'] + $row['total_survival_time']) % 60) != 1 ? 's' : '');
		$stat_kills = $row['survivor_kills'];
		$stat_tkills = $row['survivor_kills'] + $row['total_survivor_kills'];
		$stat_bkills = $row['bandit_kills'];
		$stat_tbkills = $row['bandit_kills'] + $row['total_bandit_kills'];
		$stat_zkills = $row['zombie_kills'];
		$stat_tzkills = $row['zombie_kills'] + $row['total_zombie_kills'];
		$stat_hs = $row['headshots'];
		$stat_ths = $row['headshots'] + $row['total_headshots'];

		if ($row['humanity'] >= 5000) {
			$stat_humanity .= '<img src="images/hero.png" title="'.$hero_lng.'" alt="'.$hero_lng.'" />';
		} elseif ($row['humanity'] < 0) {
			$stat_humanity .= '<img src="images/bandit.png" title="'.$bandit_lng.'" alt="'.$bandit_lng.'" />';
		} else {
			$stat_humanity .= '<img src="images/neutral.png" title="" alt="" />';
		}

		echo '
		<tr class="'.(($nr%2) == 0 ? "tr_3" : "tr_2" ).'">
			<td>'.($nr+1).'</td>
			<td style="text-align:left;">'.$stat_name.'</td>
			<td style="text-align:left;">'.$stat_humanity.'</td>
			<td style="text-align:left;">'.$stat_life.'</td>
			<td style="text-align:left;">'.$stat_svtime.'<br /><font size="1">'.$stat_tsvtime.'</font></td>
			<td style="text-align:right;">'.$stat_kills.'<br /><font size="1">'.$stat_tkills.'</font></td>
			<td style="text-align:right;">'.$stat_bkills.'<br /><font size="1">'.$stat_tbkills.'</font></td>
			<td style="text-align:right;">'.$stat_zkills.'<br /><font size="1">'.$stat_tzkills.'</font></td>
			<td style="text-align:right;">'.$stat_hs.'<br /><font size="1">'.$stat_ths.'</font></td>
			<td style="text-align:right;">'.($stat_hs == 0 ? '0' : (round(100 / ($stat_skills + $stat_bkills + $stat_zkills) * ($stat_hs), 2))).'%<br /><font size="1">'.($stat_hs == 0 ? '0' : (round(100 / ($stat_skills + $stat_tskills + $stat_bkills + $stat_tbkills + $stat_zkills + $stat_tzkills) * ($stat_hs + $stat_ths), 2))).'%</font></td>
		</tr>';

		$nr++;
	}
	echo '</table>';
		
	mysql_close($verbindung);
	
	echo '<div align="left" id="navl">
			<table>
				<tr>
					<td class="tr_1" colspan="2">'.$lgnd_lng.'</td>
				</tr><tr>
					<td class="tr_3" style="text-align:left;">'.$bandit_lng.':</td><td class="tr_3"><img src="images/bandit.png" title="'.$bandit_lng.'" alt="'.$bandit_lng.'" /></td>
				</tr><tr>
					<td class="tr_2" style="text-align:left;">'.$hero_lng.':</td><td class="tr_2"><img src="images/hero.png" title="'.$hero_lng.'" alt="'.$hero_lng.'" /></td>
				</tr>
			</table>
		</div>';
?>