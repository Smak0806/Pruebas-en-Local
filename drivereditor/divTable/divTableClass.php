<?php
class CDivTable
{
    const ROW = 'rowItem';
    const COLUMN = 'columnItem';
    protected $m_cOrientation = CDivTable::ROW;
    protected $m_vTable = array();
    protected $m_sAdditionalClasses = '';

    function __construct($orientation = CDivTable::ROW, $style = '') 
    {
        if ($orientation == CDivTable::ROW || $orientation == CDivTable::COLUMN)
        {
            $this->m_cOrientation = $orientation;
        }
        $this->m_sAdditionalClasses = $style;
    }
    
    protected function isColumn()
    {
        return $this->m_cOrientation == CDivTable::COLUMN;
    }
    
    protected function isRow()
    {
        return $this->m_cOrientation == CDivTable::ROW;
    }
    
    public function addItem($item)
    {
        $this->m_vTable[] = $item;
    }
    
    public function auxRowsToColumns($table)
    {
        $result = array();
        
        if (!is_array($table))
        {
            $result[] = $table;
        }
        else
        {           
            $result[0] = array();

            foreach ($table as $row)
            {
                if (!is_array($row))
                {
                    $result[0][] = $row;
                }
                else
                {
                    $j = 0;
                    foreach ($row as $item)
                    {
                        if (!isset($result[$j]))
                        {
                            $result[$j] = array();
                        }
                        
                        $result[$j][] = $item;
                        $j++;
                    }
                }
            }
        }
        
        return $result;
    }
    
    protected function addRawTableContent($table)
    {
        if (!is_array($table))
        {
            $this->addItem($table);
        }
        else
        {
            foreach($table as $element)
            {
                if (is_array($element))
                {
                    $orientation = ($this->isColumn()) ? CDivTable::ROW : CDivTable::COLUMN;
                    $item = new CDivTable($orientation);
                    $item->addRawTableContent($element);
                    $this->addItem($item);
                }
                    else
                {
                    $this->addItem($element);
                }
            }
        }
    }
    
    public function addTableContent ($table)
    {
        $aux = $this->auxRowsToColumns($table);
        $this->addRawTableContent($aux);
    }
    
    public function drawTable()
    {
        $addC = ($this->m_sAdditionalClasses != '') ? ' ' . $this->m_sAdditionalClasses : '';
        $result = '<div class="' . $this->m_cOrientation . $addC . '">';
        
        foreach ($this->m_vTable as $item)
        {
            $_item = (gettype($item) != 'object') ? '<div>' . $item . '</div>' : $item->drawTable();       
            $result .= $_item;
        }
        
        $result .= '</div>';
        
        return $result;
    }
}
