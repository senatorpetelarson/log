<?php

class database {
/** @var string Internal variable to hold the query sql */
	var $_sql='';
/** @var int Internal variable to hold the database error number */
	var $_errorNum=0;
/** @var string Internal variable to hold the database error message */
	var $_errorMsg='';

/**
* Database object constructor
* @param string Database host
* @param string Database user name
* @param string Database user password
* @param string Database name
*/
	function database( $host='localhost', $user, $pass, $db ) {
	// perform a number of fatality checks, then die gracefully
		function_exists( 'mysql_connect' )
			or die( 'FATAL ERROR: MySQL support not available.  Please check your configuration.' );
		$link = mysql_connect( $host, $user, $pass )
			or die( 'FATAL ERROR: Connection to database server failed.' );
		mysql_select_db($db)
			or die( "FATAL ERROR: Database not found. Operation failed with error: ".mysql_error());
	}
/**
* Execute a database query and returns the result
* @param string The SQL query
* @return resource Database resource identifier.  Refer to the PHP manual for more information.
* @deprecated This function is included for tempoary backward compatibility
*/
	function openConnectionWithReturn($query){
		$result=mysql_query($query) or die("Query failed with error: ".mysql_error());
		return $result;
	}
/**
* Execute a database query
* @param string The SQL query
* @deprecated This function is included for temporary backward compatibility
*/
	function openConnectionNoReturn($query){
		mysql_query($query) or die("Query failed with error: ".mysql_error());
	}
/**
* @return int The error number for the most recent query
*/
	function getErrorNum() {
		return $this->_errorNum;
	}
/**
* @return string The error message for the most recent query
*/
	function getErrorMsg() {
		return str_replace( array( "\n", "'" ), array( '\n', "\'" ), $this->_errorMsg );
	}
/**
* Get a database escaped string
* @return string
*/
	function getEscaped( $text ) {
		return mysql_escape_string( $text );
	}
/**
* Sets the SQL query string for later execution.
*
* This function replaces a string identifier <var>$prefix</var> with the
* string held is the <var>_table_prefix</var> class variable.
*
* @param string The SQL query
* @param string The common table prefix
*/
	function setQuery( $sql) {
		$this->_sql = $sql;
	}
/**
* @return string The current value of the internal SQL vairable
*/
	function getQuery() {
		return "<pre>$this->_sql</pre>";
	}
/**
* Execute the query
* @return mixed A database resource if successful, FALSE if not.
*/
	function query() {
		$this->_errorNum = 0;
		$this->_errorMsg = '';
		$cur = mysql_query( $this->_sql );
		if( !$cur ) {
			$this->_errorNum = mysql_errno();
			$this->_errorMsg = mysql_error()." SQL=$this->_sql";
			return false;
		}
		return $cur;
	}
	
	function insertQuery() {
		$this->_errorNum = 0;
		$this->_errorMsg = '';
		$cur = mysql_query( $this->_sql );
		if( !$cur ) {
			$this->_errorMsg = mysql_error()." SQL=$this->_sql";
			return false;
		}
		return mysql_insert_id();
	}

/**
* @return int The number of rows returned from the most recent query.
*/
	function getNumRows( $res ) {
		return mysql_num_rows( $res );
	}

/**
* This method loads the first field of the first row returned by the query.
*
* @return The value returned in the query or null if the query failed.
*/
	function loadResult() {
		if (!($cur = $this->query())) {
			return null;
		}
		$ret = null;
		if ($row = mysql_fetch_row( $cur )) {
			$ret = $row[0];
		}
		mysql_free_result( $cur );
		return $ret;
	}
/**
* Load an array of single field results into an array
*/
	function loadResultArray($numinarray = 0) {
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mysql_fetch_row( $cur )) {
			$array[] = $row[$numinarray];
		}
		mysql_free_result( $cur );
		return $array;
	}

/**
* Load a list of database objects
* @param string The field name of a primary key
* @return array If <var>key</var> is empty as sequential list of returned records.
* If <var>key</var> is not empty then the returned array is indexed by the value
* the database key.  Returns <var>null</var> if the query fails.
*/
	function loadObjectList( $key='' ) {
		if (!($cur = $this->query())) {
			return null;
		}
		$array = array();
		while ($row = mysql_fetch_object( $cur )) {
			if ($key) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		mysql_free_result( $cur );
		return $array;
	}

/**
* Document::db_insertObject()
*
* { Description }
*
* @param [type] $keyName
* @param [type] $verbose
*/
	function insertObject( $table, &$object, $keyName = NULL, $verbose=false ) {
		$fmtsql = "INSERT INTO $table ( %s ) VALUES ( %s ) ";
		foreach (get_object_vars( $object ) as $k => $v) {
			if (is_array($v) or is_object($v) or $v == NULL) {
				continue;
			}
			if ($k[0] == '_') { // internal field
				continue;
			}
			$fields[] = "`$k`";
			$values[] = "'" . $this->getEscaped( $v ) . "'";
		}
		$this->setQuery( sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) );
		($verbose) && print "$sql<br />\n";
		if (!$this->query()) {
			return false;
		}
		$id = mysql_insert_id();
		($verbose) && print "id=[$id]<br />\n";
		if ($keyName && $id) {
			$object->$keyName = $id;
		}
		return true;
	}

/**
* Document::db_updateObject()
*
* { Description }
*
* @param [type] $updateNulls
*/
	function updateObject( $table, &$object, $keyName, $updateNulls=true ) {
		$fmtsql = "UPDATE $table SET %s WHERE %s";
		foreach (get_object_vars( $object ) as $k => $v) {
			if( is_array($v) or is_object($v) or $k[0] == '_' ) { // internal or NA field
				continue;
			}
			if( $k == $keyName ) { // PK not to be updated
				$where = "$keyName='" . $this->getEscaped( $v ) . "'";
				continue;
			}
			if ($v === NULL && !$updateNulls) {
				continue;
			}
			if( $v == '' ) {
				$val = "''";
			} else {
				$val = "'" . $this->getEscaped( $v ) . "'";
			}
			$tmp[] = "`$k`=$val";
		}
		$this->setQuery( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
		return $this->query();
	}

	function getObjectList( $index=null, $maxrows=NULL ) {
		$this->_errorNum = 0;
		$this->_errorMsg = '';

		if (!($cur = mysql_query( $this->_sql ))) {
			$this->_errorNum = mysql_errno();
			$this->_errorMsg = mysql_error();
			return false;
		}
		$list = array();
		$cnt = 0;
		while ($obj = mysql_fetch_object( $cur )) {
			if ($index) {
				$list[$obj->$index] = $obj;
			} else {
				$list[] = $obj;
			}
			if( $maxrows && $maxrows == $cnt++ ) {
				break;
			}
		}
		mysql_free_result( $cur );			
		return $list;
	}
/**
* @param boolean If TRUE, displays the last SQL statement sent to the database
* @return string A standised error message
*/
	function stderr( $showSQL = false ) {
		return "DB function failed with error number $this->_errorNum"
			."<br /><font color=\"red\">$this->_errorMsg</font>"
			.($showSQL ? "<br />SQL = <pre>$this->_sql</pre>" : '');
	}

	function insertid()
	{
		return mysql_insert_id();
	}

	function getVersion()
	{
		return mysql_get_server_info();
	}

}
 ?>