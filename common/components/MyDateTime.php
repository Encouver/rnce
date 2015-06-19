<?php
/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 18/06/2015
 * Time: 09:31 AM
 */

namespace common\components;


use DateTime;

class MyDateTime extends DateTime
{
    /**
     * Calculates start and end date of fiscal year
     * @param DateTime $dateToCheck A date withn the year to check
     * @return array('start' => timestamp of start date ,'end' => timestamp of end date)
     */
    public function fiscalYear()
    {
        $result = array();
        $start = new MyDateTime();
        $start->setTime(0, 0, 0);
        $end = new MyDateTime();
        $end->setTime(23, 59, 59);
        $year = $this->format('Y');
        $start->setDate($year, 4, 1);
        if($start <= $this){
            $end->setDate($year +1, 3, 31);
        } else {
            $start->setDate($year - 1, 4, 1);
            $end->setDate($year, 3, 31);
        }
//        $result['start'] = $start->getTimestamp();
//        $result['end'] = $end->getTimestamp();
        $result['start'] = $start;
        $result['end'] = $end;
        return $result;
    }

    /**
     * Calculates start and end date of cycle year
     * @param DateTime $dateToCheck A date withn the year to check
     * @return array('start' => timestamp of start date ,'end' => timestamp of end date)
     */
    public function cycleYear()
    {

        $start = new MyDateTime( $this->format('Y-m-d') );
        $start->modify('-1 year +1 day');
        $end = new MyDateTime( $this->format(' Y-m-d') );
        //$end->modify( '+1 days' );

/*        echo 'Fecha inicio: '.$start->format('Y-m-d');
        echo '<br> Fecha Fin: '.$end->format('Y-m-d');
        echo '<br>';
        $interval = new DateInterval('P1M');
        $daterange = new DatePeriod($start, $interval ,$end);*/

        $result['start'] = $start;
        $result['end'] = $end;
        return $result;
    }

    /**
     * Calculates start and end date of system year
     * @param DateTime $dateToCheck A date withn the year to check
     * @return array('start' => timestamp of start date ,'end' => timestamp of end date)
     */
    public function systemYear($periodA = '06-01',$periodB = '12-31')
    {


        $periodA = '-'.$periodA;
        $periodB = '-'.$periodB;
        $partialStart = (new DateTime)->format('Y').$periodA;
        $partialEnd = (new DateTime)->format('Y').$periodB;

        $start = new MyDateTime($partialStart);
        $end = new MyDateTime($partialEnd);
        $now = new MyDateTime();

        if($start == $end)
            return false;
        if($start > $end)
            if($now < $start){
                $partialStart = ((new DateTime)->format('Y')-1).$periodA;
                $partialEnd = (new DateTime)->format('Y').$periodB;
            }else{
                $partialStart = (new DateTime)->format('Y').$periodA;
                $partialEnd = ((new DateTime)->format('Y')+1).$periodB;
            }
        else
            if($now < $start){
                $partialStart = ((new DateTime)->format('Y')-1).$periodA;
                $partialEnd = ((new DateTime)->format('Y')-1).$periodB;
            }
        $start = new MyDateTime($partialStart);
        $end = new MyDateTime($partialEnd);
        $result['start'] = $start;
        $result['end'] = $end;
        $result['year'] = $start->format('Y');
        return $result;

    }

    /**
     * Calculates start and end date of system year
     * @param MyDateTime $start, MyDateTime $end
     * @return boolean
     */
    public function isBetween($start, $end){

        if($this >= $start and $this <= $end)
            return true;

        return false;
    }
}