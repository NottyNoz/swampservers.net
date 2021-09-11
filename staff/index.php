<?php //This file is subject to copyright - contact swampservers@gmail.com for more information. ?>
<?=common_top("Swamp Servers - Staff")?>

	<h1 class="text-center">Staff</h1>

	<?php
$staff = $db->query("SELECT * FROM users WHERE rank > 0 AND title!='HIDDEN' ORDER BY if(title LIKE '%Movie%',2.5,rank) DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
function SteamCardWrap($row)
{
    $title = htmlspecialchars($row['title']);
    if ($title == "") {$title = "Cyber Police";}
    global $SignedInRank;
    if ($SignedInRank > RANK_USER) {
        $title .= "<br>Last login: " . date("F j", $row['login_t']) . "<br>" . SteamID64toID($row['id64']);
    }
    SteamCard($row['id64'], $title);
}
?>
<?php /*
<div class="text-center"> <?php SteamCardWrap(array_shift($staff));    ?> </div>
<div class="text-center" style="zoom:0.875;"> <?php SteamCardWrap(array_shift($staff));    ?> </div>
 */?>
	<div class="row" style="zoom:0.75;">
	<div class="col-sm-6 text-right">
		<?php
$do = true;
foreach ($staff as $user) {
    if ($do) {
        SteamCardWrap($user);
    }
    $do = !$do;
}
?>
	</div>
	<div class="col-sm-6 text-left">
		<?php
$do = false;
foreach ($staff as $user) {
    if ($do) {
        SteamCardWrap($user);
    }
    $do = !$do;
}
?>
</div>
</div>

<div style="display:none;">
    
    <?php //SteamCard(76561198103347732, "backstabbing asshole"); 
    ?>
    <?php SteamCard(76561198116249190, "ex-redditor"); ?>
</div>


<h3 class="text-center">Want to join staff?</h3>
<p class="text-center">
    If you want to develop (code, model, map etc.) ask Swamp.<br>
    <?php if (count($staff) >= 22) {?>
        <strong>Moderator positions are currently full.</strong>
    <?php } else {?>
        If you want to moderate (enforce rules), ask any staff.
    <?php }?>
</p>

<?=common_bottom()?>