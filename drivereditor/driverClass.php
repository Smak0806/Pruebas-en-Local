<?php

require_once 'divTable/divTableClass.php';

function cmpFunc ($a, $b)
{
    $aT = $a['type'];
    $bT = $b['type'];

    if ($aT == CDriver::COMMENT || $bT == CDriver::COMMENT)
    {
        return 0;
    }

    if ($aT == CDriver::ACK || $bT == CDriver::ACK)
    {
        return ($bT == CDriver::ACK) ? 1 : -1;
    }
    
    if (!isset($a[CDriver::tAddress]))
    {
        return -1;
    }
    
    if (!isset($b[CDriver::tAddress]))
    {
        return 1;
    }

    return ($a[CDriver::tAddress] < $b[CDriver::tAddress]) ? -1 : 1;
}
    
class CDriver
{
    private $m_arrInstructions;
    private $m_arrAddrMap;
    private $m_arrVarnameMap;
    private $m_arrDictionary;
    
    const INSTRUCTION = 1;
    const ACK = 2;
    const COMMENT = 3;
    
    const tTypeOfResource = 0;
    const tCommand = 1;
    const tAddress = 2;
    const tNrWords = 3;
    const tConversion = 4;
    const tBitmask = 5;
    const tDecimalPoint = 6;
    const tUnit = 7;
    const tVarname = 8;
    const tAck = 8;
    const tFormat = 9;
    const tAckExpectedVal = 9;
    const tReadMode = 10;
    const tAckMAXW = 10;
    const tReadPeriod = 11;
    const tAckMaxNrOfWords = 11;
    const tAckRAM = 12;
    const tWriteMode = 14;
    const tWritePeriod =15;
    const tMinValue = 20;
    const tMaxValue = 21;
    const tExistence = 22;
    const tComments = 23;
    const tReserved = -1;
    
    const vAckInstruction = array(  CDriver::tTypeOfResource,
                                    CDriver::tCommand,
                                    CDriver::tAddress,
                                    CDriver::tNrWords,
                                    CDriver::tConversion,
                                    CDriver::tBitmask,
                                    CDriver::tDecimalPoint,
                                    CDriver::tUnit,
                                    CDriver::tAck,
                                    CDriver::tAckExpectedVal,
                                    CDriver::tAckMAXW,
                                    CDriver::tAckMaxNrOfWords,
                                    CDriver::tAckRAM);
    
    const vInstruction = array( CDriver::tTypeOfResource,
                                CDriver::tCommand,
                                CDriver::tAddress,
                                CDriver::tNrWords,
                                CDriver::tConversion,
                                CDriver::tBitmask,
                                CDriver::tDecimalPoint,
                                CDriver::tUnit,
                                CDriver::tVarname,
                                CDriver::tFormat,
                                CDriver::tReadMode,
                                CDriver::tReadPeriod,
                                CDriver::tReserved,
                                CDriver::tReserved,
                                CDriver::tWriteMode,
                                CDriver::tWritePeriod,
                                CDriver::tReserved,
                                CDriver::tReserved,
                                CDriver::tReserved,
                                CDriver::tReserved,
                                CDriver::tMinValue,
                                CDriver::tMaxValue,
                                CDriver::tExistence);
    
    private $m_arrColumnSizes = array(16, 11, 9, 8, 10, 8, 6, 13, 15, 10, 10, 11, 0, 0, 10, 12, 0, 0, 0, 0, 10, 10, 50, 50);
    
    function __construct () 
    { 
    }
    
    private function createAddressMap ()
    {
        $this->m_arrAddrMap = array();
        $this->m_arrVarnameMap = array();
        foreach ($this->m_arrInstructions as $line)
        {
            if (!isset($line[CDriver::tAddress]) || !isset($line[CDriver::tVarname]))
            {
                continue;
            }
            $this->m_arrAddrMap[$line[CDriver::tAddress]] = $line[CDriver::tVarname];
            $this->m_arrVarnameMap[$line[CDriver::tVarname]] = $line[CDriver::tAddress];
        }
    }
    
    private function convertAddressesToVarnames ($str)
    {
        preg_match_all ('~@[0-9]+~', $str, $matches, PREG_OFFSET_CAPTURE);
       
        $result = $str;
        if (count($matches) > 0)
        {
            foreach ($matches[0] as $m)
            {
                $result = str_replace($m[0], '{' . $this->m_arrAddrMap[substr($m[0], 1)]. '}',$result) ;
            }
        }
        return $result;
    }
    
    private function convertVarnamesToAddresses ($str)
    {
        preg_match_all ('~{[^{]+}~', $str, $matches, PREG_OFFSET_CAPTURE);
        $result = $str;
        if (count($matches) > 0)
        {
            foreach ($matches[0] as $m)
            {
                $result = str_replace($m[0], '@' . $this->m_arrVarnameMap[substr($m[0], 1, strlen($m[0]) - 2)],$result) ;
            }
        }
        return $result;
    }
    
    private function normalize($table)
    {
        $maxVal = 0;

        foreach($table as $item)
        {
            $maxVal = (count($item) > $maxVal) ? count($item) : $maxVal;
        }
        
        $result = array();
        foreach ($table as $row=>$item)
        {
            $newRow = $item;
            $nIt = count($item);
            $diff = $maxVal - $nIt;
            if ($diff > 0)
            {
                $offset = 0;
                for($i = 0; $i < $diff; $i++)
                {
                    $size = 10;
                
                    /*if (isset($this->m_arrColumnSizes[$nIt + $i + $offset]))
                    {
                        while ($this->m_arrColumnSizes[$nIt + $i + $offset] == 0 && isset($this->m_arrColumnSizes[$nIt + $i + $offset]))
                        {
                            $offset ++;
                        }
                        $size = $this->m_arrColumnSizes[$nIt + $i + $offset];
                    }*/
                    $newRow[] = '<div class="divCell_' . $row . '" id="divCell_' . $row . '_' . ($nIt + $i) . '"><input type="text" size="' . $size . '" disabled></div>';
                }
            }
            $result[] = $newRow;
        }
        return $result;
    }
    
    public function readDriver($data)
    {
        $this->m_arrInstructions = array();
        $lines = explode("\n", $data);
        
        foreach ($lines as $_line)
        {
            $line = trim($_line);
            
            $typeOfLine = CDriver::INSTRUCTION;
            
            $comments = false;
            
            if ($line != '' && $line[0] == '#')
            {
                $typeOfLine = CDriver::COMMENT;
                $line = substr($line, 1);
            }
            else if ($line != '')
            {
                $_laux = explode('#', $line);
                $line = $_laux[0];
                
                if (count($_laux) > 1)
                {
                    array_shift($_laux);
                    $comments = '#';
                    if (is_array($_laux))
                    {
                        $comments .= implode($_laux);
                    }
                }
                
                if (strpos($line, 'ACK') !== false)
                {
                    $typeOfLine = CDriver::ACK;
                }
            }
            
            $n = array();
            $n['type'] = $typeOfLine;
            
            $_items = explode(';', $line);

            foreach ($_items as $item)
            {
                $n[] = $item;
            }

            if ($comments !== false)
            {
                $n[] = $comments;
            }
            
            $this->m_arrInstructions[] = $n;
        }
        
        $this->createAddressMap();
    }
    
    private function getTranslation($str)
    {
        if (!is_array($this->m_arrDictionary))
        {
            return false;
        }
        
        foreach ($this->m_arrDictionary as $dict)
        {
            $result = '';
            if (strpos($str, '(') === false)
            {
                $result = (isset($dict[$str])) ? $dict[$str] : false;
                
                if ($result === false)
                {
                    continue;
                }
            }
            else
            {
                $arr = explode('(', $str);
                $numbers = explode(',', $arr[1]);

                if (!isset($dict[$arr[0]]))
                {
                    continue;
                }

                $result = $dict[$arr[0]];

                $nr = substr_count($result, '$');

                for ($i=1; $i <= $nr; $i++)
                {
                    $val = (isset($numbers[$i-1])) ? $numbers[$i-1] : '';
                    $result = str_replace('$' . strval($i), $val, $result);
                }
            }
            return $result;
        }
        
        return false;
    }
    
    public function printDriverTable()
    {
        $result = '<input type="hidden" id="nRows" value="' . count($this->m_arrInstructions) . '">';
        $result .= '<table id="tDriver">';
        
        foreach ($this->m_arrInstructions as $row => $line)
        {
            $css = ($line['type'] == CDriver::COMMENT) ? ' style="background-color:#C8C8C8;"' : '';
            $chk = ($line['type'] == CDriver::COMMENT) ? ' checked' : '';
            
            $result .= '<tr id="ln_' . $row . '">';
            $result .= '<input type="hidden" id="nCols_' . $row . '" value="' . count($line) . '">';
            $result .= '<td>';
            $result .= '<button class="btnTransparentSmall btnDel" id="btnDel_' . $row . '"><span class="icon-cross"></span></button><input type="checkbox" id="cmt_' . $row . '"' . $chk . ' class="commentCheckBox tableElement">#';
            $result .= '</td>';
            
            $myCols = ($line['type'] == CDriver::ACK) ? CDriver::vAckInstruction : CDriver::vInstruction;
            
            foreach ($line as $column => $item)
            {
                if ($column === 'type' || $item === 'RESERVED' || (isset($this->m_arrColumnSizes[$column]) && $this->m_arrColumnSizes[$column] == 0) || (isset($myCols[$column]) && $myCols[$column] == CDriver::tReserved))
                {
                    continue;
                }
                
                $size = (isset($this->m_arrColumnSizes[$column])) ? $this->m_arrColumnSizes[$column] : 10;

                $result .= '<td>';
                
                if ($column == CDriver::tComments)
                {
                    $result .= '<input type="text" class="tableElement" style="background-color:#C8C8C8;" id="ln_' . $row . '_' . $column . '" value="' . $item . '" size="' . $size . '">';
                }
                else if ($item != '' || (isset($myCols[$column]) && $myCols[$column] != CDriver::tReserved && $line['type'] != CDriver::COMMENT))
                {
                    $_result = '<input type="text" class="tableElement"' . $css . ' id="ln_' . $row . '_' . $column . '" value="' . $item . '" size="' . $size . '">';
                    
                    if ($column === CDriver::tExistence)
                    {
                        $item = $this->convertAddressesToVarnames($item);
                        $_result = '<textarea class="tableElement"' . $css . ' id="ln_' . $row . '_' . $column . '" cols="' . $size . '" rows="1">' . $item . '</textarea>';
                    }
                    
                    if ($column === CDriver::tVarname)
                    {
                        $translation = $this->getTranslation($item);
                        $_result = ($translation !== false) ? $_result . '<div><textarea cols="25" rows="1" readonly>' . $translation . '</textarea></div>' : $_result;
                    }
                    
                    $result .= $_result;
                }
                
                $result .= '</td>';
            }
            
            $result .= '</tr>';
        }
        
        $result .= '<tr id="addRow"><td colspan="2"><br><button class="btnTransparent" id="btnAdd"><span class="icon-plus"></span></button><br></td></tr>';
        $result .= '</table>';
        return $result;
    }
        
    /*public function printDriverTable()
    {
        $myTable = array();
        
        $result = '<input type="hidden" id="nRows" value="' . count($this->m_arrInstructions) . '">';
        
        foreach ($this->m_arrInstructions as $row => $line)
        {
            $css = ($line['type'] == CDriver::COMMENT) ? ' style="background-color:#C8C8C8;"' : '';
            $chk = ($line['type'] == CDriver::COMMENT) ? ' checked' : '';
            
            $myRow = array();
            
            $result .= '<input type="hidden" id="nCols_' . $row . '" value="' . count($line) . '">';
            
            $myRow[] = '#<input type="checkbox" id="cmt_' . $row . '"' . $chk . ' class="commentCheckBox tableElement">';
            
            $myCols = ($line['type'] == CDriver::ACK) ? CDriver::vAckInstruction : CDriver::vInstruction;
            
            foreach ($line as $column => $item)
            {
                if ($column === 'type' || $item === 'RESERVED' || (isset($this->m_arrColumnSizes[$column]) && $this->m_arrColumnSizes[$column] == 0) || (isset($myCols[$column]) && $myCols[$column] == CDriver::tReserved))
                {
                    continue;
                }
                
                $size = (isset($this->m_arrColumnSizes[$column])) ? $this->m_arrColumnSizes[$column] : 10;
                
                if ($column == CDriver::tComments)
                {
                    $myRow[] = '<input type="text" class="tableElement" style="background-color:#C8C8C8;" id="ln_' . $row . '_' . $column . '" value="' . $item . '" size="' . $size . '">';
                }
                else if ($item != '' || (isset($myCols[$column]) && $myCols[$column] != CDriver::tReserved && $line['type'] != CDriver::COMMENT))
                {
                    $_result = '<input type="text" class="tableElement"' . $css . ' id="ln_' . $row . '_' . $column . '" value="' . $item . '" size="' . $size . '">';
                    
                    if ($column === CDriver::tExistence)
                    {
                        $item = $this->convertAddressesToVarnames($item);
                        $_result = '<textarea class="tableElement"' . $css . ' id="ln_' . $row . '_' . $column . '" cols="' . $size . '" rows="1">' . $item . '</textarea>';
                    }
                    
                    if ($column === CDriver::tVarname)
                    {
                        $translation = $this->getTranslation($item);
                        $_result = ($translation !== false) ? $_result . '<div><textarea cols="25" rows="1" readonly>' . $translation . '</textarea></div>' : $_result;
                    }
                    
                    $myRow[] = '<div class="divCell_' . $row . '" id="divCell_' . $row . '_' . $column . '">' . $_result . '</div>';
                }
            }
            
            $myTable[] = $myRow;
        }
        
        $myDivTable = new CDivTable();
        $myDivTable->addTableContent($this->normalize($myTable));

        $result .= $myDivTable->drawTable();
        return $result;
    }    */
    
    public function toCSV ($driver)
    {
        $result = '';
        foreach ($driver as $line)
        {
            if (is_array($line) === false)
            {
                continue;
            }
            if ($line['type'] == CDriver::COMMENT)
            {
                $result .= '#';
            }
            foreach ($line as $column=>$item)
            {
                if ($column === 'type')
                {
                    continue;
                }
                
                if (strpos($item,'#') === 0)
                {
                    $result = rtrim($result, ';');
                }
                
                if ($column == CDriver::tExistence)
                {
                    $item = $this->convertVarnamesToAddresses($item);
                }
                
                $result .= $item . ';';
            }
            $result = rtrim($result, ';') . "\n";
        }
        return $result;
    }
    
    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    
    public function addDictionary ($dictionary, $index)
    {
       if ($this->isJson($dictionary))
       {
           $this->m_arrDictionary[$index] = (array)json_decode($dictionary);
       }
    }
    
    public function sortDriver ()
    {
        //print_r($this->m_arrInstructions);
        usort($this->m_arrInstructions, 'cmpFunc');
    }
}
