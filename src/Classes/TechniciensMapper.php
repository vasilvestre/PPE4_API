<?php

/**
 * Created by PhpStorm.
 * User: vsilvestre
 * Date: 12/01/17
 * Time: 11:51
 */
class TechniciensMapper
{
    public function getTechniciens($container){
        $sql = "SELECT loginT, prenom
            from technicien";
        $stmt = $this->db-> query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new TicketEntity($row);
        }
        return $results;
    }

}