<?php

////////////////////////////////////////////////////////////
/*

user_regdate -> user_registred  (timestamp -> date )
user_website -> user_url
user_email -> user_email
username -> user_login
//
user_lastvisit -> ad_login_timestamp
user_from -> loc_city
user_msnm -> msn
user_jabber -> jabber

*/
////////////////////////////////////////////////////////////

function import_all_users_from_phpbb()
{
  $phpbb_root_path = ABSPATH.PHPBBPATH;
  require($phpbb_root_path.'config.php');
  $dbr = mysql_connect($dbhost,$dbuser,$dbpasswd);
  mysql_select_db($dbname);
  define('USERS_TABLE', $table_prefix . 'users');

  $sql = 'SELECT user_id, user_regdate, user_website, user_email, username, 
                 user_lastvisit, user_from, user_msnm, user_jabber
                FROM ' . USERS_TABLE . "
                ORDER BY user_id";

  $result = mysql_query($sql);

  echo "<div id='content'>";
  echo "<h2>Importerade dessa hjältar</h2>";
  echo "<table class='widefat fixed'>";
  echo "<thead><tr class='thead'><th>Id</th><th>Användarnamn</th><th>E-post</th><th>Ort</th><th>Senast inloggad</th></tr></thead><tbody id='users' class='list:user user-list'>";
  while( $row = mysql_fetch_object($result) )
    {
      if( !$row->user_lastvisit                 ) continue;
      if( get_user_by('login',$row->username)   ) continue;
      if( get_user_by('email',$row->user_email) ) continue;

      $timezone = new DateTimeZone( "Europe/Stockholm" );
      $dt = new DateTime('@'.$row->user_regdate);
      $dt->setTimezone( $timezone );
      
      $user = wpbb_WordPress::addUser(array(
					    'username'  => $row->username,
					    'email'     => $row->user_email,
					    'password'  => wp_generate_password(),
					    ));

      $userdata = array(
			'ID'              => $user->ID,
			'user_login'      => $row->username,
			'user_email'      => $row->user_email,
			'user_url'        => $row->user_website,
			'user_registered' => $dt->format( 'Y-m-d H:i:s' ),
			);

      $uid = wp_insert_user($userdata);

      if( is_wp_error($uid) )
	{
	  echo '<div id="message" class="error"><h2>'.$row->username.'</h2><p>' . $uid->get_error_message() . '</p></div>';
	  break;
	}


      update_user_meta( $uid, 'ad_login_timestamp', $row->user_lastvisit );
      update_user_meta( $uid, 'loc_city', $row->user_from );
      update_user_meta( $uid, 'msn', $row->user_msnm );
      update_user_meta( $uid, 'jabber', $row->user_jabber );


      echo "<tr><td>";
            echo $uid;
      echo "</td><td>";
      echo $row->username;
      echo "</td><td>";
      echo $row->user_email;
      echo "</td><td>";
      echo $row->user_from;
      echo "</td><td>";
      echo $dt->format( 'Y-m-d H:i:s' );
      echo "</td></tr>";

    }
  echo "</tbody></table></div>";
  mysql_free_result($result);
  return;
}

?>