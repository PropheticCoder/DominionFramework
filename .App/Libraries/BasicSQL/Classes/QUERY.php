<?php
namespace libraries\BasicSQL;
use libraries\BasicSQL\DB;

/**
 * SQL Class, Queries the database
 * @author PropheticCoder  https://github.com/PropheticCoder
 * @copyright PropheticCoder  https://github.com/PropheticCoder
 * @version 1.0
 */
class QUERY extends DB{
    /**
     * Check if table is valid
     * @throws exception
     */
    private static function tableIsValid(string $tableName){
        DB::scanDB();
        if(!in_array($tableName,parent::$tables)) throw new \Exception('Unknown database table');
    }

    /**
     * Scan filter for validity
     * @param array $filter
     * @throws Exception
     */
    private static function filterIsValid(array $filter){
        if(count($filter) >2) throw new \Exception('Invalid filter count');
    }

    /**
     * append filter to SQL statement
     * @param string $sql
     * @param array $filter
     * @return string $sql
     */
    private static function appendFilter(string $sql,array $filter=null){
        if($filter==null) return $sql;
        $filterKey = 1;
        foreach ($filter as $filter => $filterVal) {
            $sql .= ($filterKey == 1) ? " WHERE $filter= '$filterVal'" : " AND $filter = '$filterVal'";
            $filterKey++;
        }
        return $sql;
    }
    
    /**
     * Select a table
     * If a filter is given, it is placed aftter the where clause, only 2 filters allowed at a time
     * @param string $tableName
     * @param array $filter
     * @return array $tableRecords
     */
    public static function SELECT(string $tableName,array $filter=null){
        $tableRecords=array();
        self::tableIsValid($tableName);
        $sql = "SELECT * FROM ".$tableName;
        $sql =self::appendFilter($sql,$filter);
        $query = self::connect()->query($sql);
        if($query ==false) throw new \Exception('Invalid SQL Query');
        while($row=$query->fetch()){
            array_push($tableRecords,$row);
        }
        return $tableRecords;
    }

    /**
     * Insert data into table
     * @param string $tableName
     * @param array $filter
     * @return array $tableRecords
     */
    public static function INSERT(string $tableName,array $data){
        self::tableIsValid($tableName);
        $fieldKey=1;
        $sql="INSERT INTO ".$tableName." (";
        foreach($data as $field => $fieldVal){
            $sql .=($fieldKey==1) ? $field :",".$field;
            $fieldKey++;
        }
        $sql .=") VALUES (";
        $fieldKey=1;
        foreach ($data as $field => $fieldVal) {
            $sql .= ($fieldKey == 1) ? "'$fieldVal'" : "," . "'$fieldVal'";
            $fieldKey++;
        }
        $sql .= ")";
        $query=self::connect()->query($sql);
        return true;
    }

    /**
     * Update a table
     * If a filter is given, it is placed aftter the where clause, only 2 filters allowed at a time
     * @param string $tableName
     * @param array $filter
     * @return array $tableRecords
     */
    public static function UPDATE(string $tableName,array $data,array $filter){
        self::tableIsValid($tableName);
        $sql="UPDATE $tableName SET";
        foreach($data as $field =>$fieldVal){
            $sql .=" $field = $fieldVal";
        }
        $sql =self::appendFilter($sql,$filter);
        $query=self::connect()->query($sql);
        return true;
    }

    /**
     * Update an exisiting record or create a new one
     * @param string $tableName
     * @param  array $data
     *@param array $filter;
     */
    public static function UPSERT(string $tableName, array $data,array $filter){
        $tableRecords=self::SELECT($tableName,$filter);
        if(count($tableRecords)==0){
            self::INSERT($tableName,$data);
        } else if (count($tableRecords) > 0) {
            self::UPDATE($tableName,$data,$filter);
        }
    }
    /**
     * Delete from table
     * If a filter is given, it is placed aftter the where clause, only 2 filters allowed at a time
     * @param string $tableName
     * @param array $filter
     * @return array $tableRecords
     */
    public static function DELETE(string $tableName,array $filter){
        self::tableIsValid($tableName);
        $sql="DELETE FROM $tableName";
        $sql =self::appendFilter($sql,$filter);
        $query = self::connect()->query($sql);
        return true;
    }
}