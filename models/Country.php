<?php

namespace Models;

use Config\Db;

class Country extends Db
{
    public function save($data)
    {
        $valsCols = ":" . join(",:", array_keys($data));
        $keysCols = join(",", array_keys($data));

        $sql = "INSERT INTO country ($keysCols ) VALUES ($valsCols)";
        $stmt = $this->getConnection()->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $error) {
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM country";
        $stmt = $this->getConnection()->prepare($sql);

        try {
            $stmt->execute();
        } catch (\PDOException $error) {
        }
    }

    public function update($id, $data)
    {
    }

    public function delete($id)
    {
    }

    public function get($id)
    {
    }
}
