<?php
namespace app\Widgets;

use Arrilot\Widgets\AbstractWidget;
use TCG\Voyager\Facades\Voyager;
use Auth;
use App\Owner;
use App\Employee;
use App\User;
use App\Pharmacy;
use TCG\Voyager\Models\Role;

class UserDimmer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = 0;

        $countP = "";
        $stringP = "";
        $add = "Click on button below to view all employees.";
        $button = true;
        $gg = "in your";

        if( Auth::user()->hasRole('owner') ){

            if( Auth::user()->pharmacies()->count() > 0 ){
                $countP = Auth::user()->pharmacies()->count();

                foreach (Auth::user()->pharmacies()->get() as $item) {
                    $count += $item->employees()->count();
                }
            }
            $stringP = $countP <= 1 ? 'pharmacy' : 'pharmacies';
            $countP = $countP <= 1 ? '' : $countP;

            $string = $count <= 1 ? 'employee' : 'employees';

        }else{
            $count = Owner::count();
            $button = false;
            $string = $count <= 1 ? 'account' : 'accounts';
            $add = "";
            $gg = "registered";
        }


        $set = [
            'icon'   => 'voyager-group',
            'title'  => "{$count} ".ucfirst($string),
            'text'   => "You have {$count} {$string} {$gg} {$countP} {$stringP}. {$add} ",
            'button' => [
                'text' => 'View all employees',
                'link' => route('voyager.employees.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.png'),
        ];
        if( ! $button ){
            $set['button'] = [
                'text' => 'View all Accounts',
                'link' => route('voyager.owners.index'),
            ];
        }


        return view('voyager::dimmer', array_merge($this->config, $set));
    }
}