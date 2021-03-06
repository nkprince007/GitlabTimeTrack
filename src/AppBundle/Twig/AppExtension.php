<?php
namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('gitlab_time_format', array($this, 'gitlabTimeFormatFilter')),
        );
    }

    /**
     * Filter for formatting times as in GitLab
     * e.g. 1d 15h 30m  or  1h 10m
     * @param $number
     * @return string
     */
    public function gitlabTimeFormatFilter($number)
    {
        if($number == null) {
            return 0;
        }
        $output = '';
        $days = floor($number/(60*60*24));
        if ($days > 0) {
            $output .= $days . 'd ';
        }
        $number -= $days*60*60*24;

        $output .= gmdate('G\\h i\\m', $number);

        return $output;
    }
}
