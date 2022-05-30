<?php
interface Filter{
    public function sort($table,$type,$fitler);
    public function search($table,$columns,$search);
}