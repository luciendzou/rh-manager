<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Month;
use App\Models\Utilisateurs;
use Illuminate\Http\Request;

class AdminNavigationController extends Controller
{
    function Dashboard()
    {
        $adminData = Utilisateurs::where('code', session()->get('code'))->first();

        return view('admin.home')->with('adminData', $adminData);
    }

    function ListUser()
    {
        $adminData = Utilisateurs::where('code', session()->get('code'))->first();
        $allUser = Utilisateurs::all();

        return view('admin.pages.users.list_users')->with('adminData', $adminData)
            ->with('allUser', $allUser);
    }


    function AddUser()
    {

        $adminData = Utilisateurs::where('code', session()->get('code'))->first();
        $userLog = Utilisateurs::orderByDesc('id_utilisateurs')->first();
        $code = "";

        if (strlen(intval($userLog->code)) == 1 && intval($userLog->code) != 9) {
            $code = "00000" . intval($userLog->code) + 1;
        }

        if (strlen(intval($userLog->code)) == 1 && intval($userLog->code) == 9) {
            $code = "0000" . intval($userLog->code) + 1;
        }

        if (strlen(intval($userLog->code)) == 2) {
            $code = "0000" . intval($userLog->code) + 1;
        }

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@#$%?&!';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $password = implode($pass);

        return view('admin.pages.users.add_user')->with('code', $code)->with('password', $password)->with('adminData', $adminData);
    }


    function DataAttendence($start, $end)
    {
        if ($start == 'start' && $end == 'end') {
            $adminData = Utilisateurs::where('code', session()->get('code'))->first();
            $from = date('Y-m-d');
            $to = date('Y-m-d');

            $attendence = Attendence::join('utilisateurs', 'attendences.id_utilisateurs', '=', 'utilisateurs.id_utilisateurs')
                ->whereBetween('date_check', [$from, $to])
                ->get(['attendences.*', 'utilisateurs.name', 'utilisateurs.poste', 'utilisateurs.location']);

            return view('admin.pages.presence.data_attendence')->with('adminData', $adminData)
                ->with('attendence', $attendence)->with('from', $from)->with('to', $to);

        } else {

            $adminData = Utilisateurs::where('code', session()->get('code'))->first();
            $from = $start;
            $to = $end;

            $attendence = Attendence::join('utilisateurs', 'attendences.id_utilisateurs', '=', 'utilisateurs.id_utilisateurs')
                ->whereBetween('date_check', [$from, $to])
                ->get(['attendences.*', 'utilisateurs.name', 'utilisateurs.poste', 'utilisateurs.location']);

            return view('admin.pages.presence.data_attendence')->with('adminData', $adminData)
                ->with('attendence', $attendence)->with('from', $from)->with('to', $to);
        }

    }

    function DataMonth($id)
    {
        if ($id == 'month') {

            $adminData = Utilisateurs::where('code', session()->get('code'))->first();
            $month = Month::all();
            $daysNbre = Month::where('id_month', intval(date('m')))->get();
            $days = $dayly = 0;
            foreach ($daysNbre as $key) {
                $days = $key['days'];
                $dayly = $key['id_month'];
            }

            $alluser = Utilisateurs::where('poste', '!=', 'DIRECTEUR GENERAL')->where('poste', '!=', 'DIRECTEUR GENERAL ADJOINT')->select(['name', 'poste'])->get();

            $alluserid = Utilisateurs::where('poste', '!=', 'DIRECTEUR GENERAL')->where('poste', '!=', 'DIRECTEUR GENERAL ADJOINT')->select(['id_utilisateurs', 'name', 'poste'])->get();

            $attendence = Attendence::where('mois', intval(date('m')))->get();

            return view('admin.pages.presence.data_month')->with('adminData', $adminData)
                ->with('attendence', $attendence)
                ->with('alluser', $alluser)
                ->with('alluserid', $alluserid)
                ->with('month', $month)
                ->with('days', $days)
                ->with('dayly', $dayly);
        } else {

            $adminData = Utilisateurs::where('code', session()->get('code'))->first();
            $month = Month::all();
            $daysNbre = Month::where('id_month', intval($id))->get();
            $days = $dayly = 0;
            foreach ($daysNbre as $key) {
                $days = $key['days'];
                $dayly = $key['id_month'];
            }


            $alluser = Utilisateurs::where('poste', '!=', 'DIRECTEUR GENERAL')->where('poste', '!=', 'DIRECTEUR GENERAL ADJOINT')->select(['name', 'poste'])->get();

            $alluserid = Utilisateurs::where('poste', '!=', 'DIRECTEUR GENERAL')->where('poste', '!=', 'DIRECTEUR GENERAL ADJOINT')->select(['id_utilisateurs', 'name', 'poste'])->get();

            $attendence = Attendence::where('mois', intval($id))->get();

            return view('admin.pages.presence.data_month')->with('adminData', $adminData)
                ->with('attendence', $attendence)
                ->with('alluser', $alluser)
                ->with('alluserid', $alluserid)
                ->with('month', $month)
                ->with('days', $days)
                ->with('dayly', $dayly);
        }

    }

    function DataMonthPdf($id)
    {
        $adminData = Utilisateurs::where('code', session()->get('code'))->first();
        $month = Month::all();
        $daysNbre = Month::where('id_month', intval($id))->get();
        $days = $dayly = 0;
        foreach ($daysNbre as $key) {
            $days = $key['days'];
            $dayly = $key['id_month'];
        }


        $alluser = Utilisateurs::where('poste', '!=', 'DIRECTEUR GENERAL')->where('poste', '!=', 'DIRECTEUR GENERAL ADJOINT')->select(['name', 'poste'])->get();

        $alluserid = Utilisateurs::where('poste', '!=', 'DIRECTEUR GENERAL')->where('poste', '!=', 'DIRECTEUR GENERAL ADJOINT')->select(['id_utilisateurs', 'name', 'poste'])->get();

        $attendence = Attendence::where('mois', intval($id))->get();

        return view('admin.pages.presence.topdf')->with('adminData', $adminData)
            ->with('attendence', $attendence)
            ->with('alluser', $alluser)
            ->with('alluserid', $alluserid)
            ->with('month', $month)
            ->with('days', $days)
            ->with('dayly', $dayly);
    }

}
