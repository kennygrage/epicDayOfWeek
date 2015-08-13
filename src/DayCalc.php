<?php
    class DayCalc {
        function calcDay ($input) {
            $month_conversion_array = array(6,2,2,5,0,3,5,1,4,6,2,4);
            $month_date_year_array = explode("-", $input);
            $month_for_conversion = intval($month_date_year_array[1]);
            $month_for_conversion--;

            if (DayCalc::leapYear($month_date_year_array[0])) {
                    $month_conversion_array[0] = 5;
                    $month_conversion_array[1] = 1;
            }
            $day_code = $month_date_year_array[2];
            $day_code = intval($day_code);
            $month_code = $month_conversion_array[$month_for_conversion];
            $year_for_conversion = $month_date_year_array[0];
            $year_pattern = 0;
            if ($year_for_conversion < 1600 || $year_for_conversion >= 2400) {return "Error. Please enter a date range from 1/1/1600 to 12/31/2399";}
            else if ($year_for_conversion >= 2300 && $year_for_conversion <= 2399) {$year_for_conversion -= 300; $year_pattern = 1;}
            else if ($year_for_conversion >= 2200 && $year_for_conversion <= 2299) {$year_for_conversion -= 200; $year_pattern = 3;}
            else if ($year_for_conversion >= 2100 && $year_for_conversion <= 2199) {$year_for_conversion -= 100; $year_pattern = 5;}
            else if ($year_for_conversion >= 2000 && $year_for_conversion <= 2099) {$year_for_conversion -= 0; $year_pattern = 0;}
            else if ($year_for_conversion >= 1900 && $year_for_conversion <= 1999) {$year_for_conversion += 100; $year_pattern = 1;}
            else if ($year_for_conversion >= 1800 && $year_for_conversion <= 1899) {$year_for_conversion += 200; $year_pattern = 3;}
            else if ($year_for_conversion >= 1700 && $year_for_conversion <= 1799) {$year_for_conversion += 300; $year_pattern = 5;}
            else if ($year_for_conversion >= 1600 && $year_for_conversion <= 1699) {$year_for_conversion += 400; $year_pattern = 0;}
            else {return "what?";}

            $day_of_week_array = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

            $year_code = (
                    (floor($year_for_conversion - 2000) / 4)
                    + ($year_for_conversion - 2000)
                    ) % 7; //2099 - floor(99 / 4) = 24; 24 + 99 = 123; 123 % 7 = 4
            $year_code += $year_pattern;
            $day_of_week_element = $month_code + $day_code + $year_code;

            while ($day_of_week_element > 6) {
                $day_of_week_element -= 7;
                if($day_of_week_element < 0) {
                    return "less than 0";
                }
            }
            return $day_of_week_array[$day_of_week_element];
        }



        function leapYear($year) {
            if ($year % 4 == 0) {
                if ($year % 100 == 0) {
                    if ($year % 400 == 0) {return true;}
                    else {return false;}
                }
                else {return true;}
            }
            else {return false;}
        }
    }
?>
