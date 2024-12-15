<?php
    /**
     * @Project: Virtual Airlines Manager (VAM)
     * @Author: Alejandro Garcia
     * @Web http://virtualairlinesmanager.net
     * Copyright (c) 2013 - 2016 Alejandro Garcia
     * VAM is licenced under the following license:
     *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
     *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
     */
?>
<?php
function convertTime($dec,$format)
{
    if ($format>0)
    {
        return $dec;
    }
    else
    {
        // start by converting to seconds
        $seconds = ($dec * 3600);
        // we're given hours, so let's get those the easy way
        $hours = floor($dec);
        // since we've "calculated" hours, let's remove them from the seconds variable
        $seconds -= $hours * 3600;
        // calculate minutes left
        $minutes = floor($seconds / 60);
        // remove those from seconds as well
        //$seconds -= $minutes * 60;
        // return the time formatted HH:MM:SS
        return lz($hours).":".lz($minutes);
    }
}
// lz = leading zero
function lz($num)
{
    return (strlen($num) < 2) ? "0{$num}" : $num;
}
?>