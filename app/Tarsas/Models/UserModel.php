<?php

namespace Tarsas\Models;

class UserModel extends Model
{
  function kereses_fnev_alapjan($fnev)
  {
    $this->res = $this->db->prepare('
      SELECT *
      FROM user
      WHERE username LIKE :fnev
    ');
    $this->res->execute([
      'fnev' => $fnev
    ]);
    return $this->res->fetchAll();
  }

  function kereses_id_alapjan($id)
  {
    $this->res = $this->db->prepare('
            SELECT *
            FROM user
            WHERE id = :id    
    ');
    $this->res->execute([
      'id' => $id
    ]);
    return $this->res->fetchAll();
  }

  function kereses_cim_alapjan($cim)
  {
    $this->res = $this->db->prepare('
            SELECT *
            FROM user
            WHERE cim = :cim    
    ');
    $this->res->execute([
      'cim' => $cim
    ]);
    return $this->res->fetchAll();
  }

  function felhasznalo_letrehozas($fullname, $email, $username, $password)
  {
    $this->res = $this->db->prepare("
      INSERT INTO user
      (fullname, email, username, password)
      VALUES (':fullname', ':email', ':username', SHA1(':password'))
  ");
    $this->res->execute([
      'fullname' => $fullname,
      'email' => $email,
      'username' => $username,
      'password' => $password
    ]);
    return $this->res->fetchAll();
  }

  function felhasznalo_jatekai($jatekok, $user_id, $sajat = false, $szivesen = false)
  {
    $insert_id = [];
    foreach ($jatekok as $game_id) {
      $this->res = $this->db->prepare("
        INSERT INTO user_has_games
        (user_id, games_id, sajat, szivesen)
        VALUES (':user_id', ':game_id', :sajat, :szivesen)
      ");
      $this->res->execute([
        'user_id' => $user_id,
        'game_id' => $game_id,
        'sajat' => $sajat,
        'szivesen' => $szivesen
      ]);
      $this->res->fetch();
      $insert_id [] = $this->db->lastInsertId();
    }
    if (count($insert_id)) {
      return $insert_id;
    }
    return false;
  }

  function felhasznalo_jatek_tipusok($jatek_tipusok, $user_id)
  {
    $insert_id = [];
    foreach ($jatek_tipusok as $type_id) {
      $this->res = $this->db->prepare("
        INSERT INTO user_has_game_types
        (user_id, game_type_id)
        VALUES (':user_id', ':type_id')
      ");
      $this->res->execute([
        'user_id' => $user_id,
        'type_id' => $type_id
      ]);
      $this->res->fetch();
      $insert_id [] = $this->db->lastInsertId();
    }
    if (count($insert_id)) {
      return $insert_id;
    }
    return false;
  }

  function kereses_user_id_alapjan($user_id)
  {
    $this->res = $this->db->prepare('
      SELECT *
      FROM user_has_game
      INNER JOIN game ON game.id = user_has_game.game_id
      WHERE user_id = :user_id    
    ');
    $this->res->execute([
      'user_id' => $user_id
    ]);
    return $this->res->fetchAll();
  }
}
