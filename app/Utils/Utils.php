<?php

namespace App\Utils;

use App\Models\CustomerType;
use App\Models\ProductCategory;

/*
0-prospect
1-negociation
2-following
3-cierre
4-reject
5-cliente
6- inactive
*/

class Utils
{
    public static function formatStatus($idStatus, $isPlural = false)
    {
        //$idStatus = intval($idStatus);
        switch ($idStatus) {
            case '0':
                return $isPlural ? 'Prospectos' : 'Prospecto';
                break;
            case '1':
                return $isPlural ? 'En negociación' : 'Negociación';
                break;
            case '2':
                return $isPlural ? 'En seguimiento' : 'Seguimiento';
                break;
            case '3':
                return $isPlural ? 'En cierre' : 'Cierre';
                break;
            case '4':
                return $isPlural ? 'Rechazados' : 'Rechazo';
                break;
            case '5':
                return $isPlural ? 'Activos' : 'Cliente Activo';
                break;
            case '6':
                return $isPlural ? 'Inactivos' : 'Cliente Inactivo';
                break;
            default:
                return 'No especificado';
        }
    }

    public static function formatStatusEmoticons($idStatus)
    {
        //$idStatus = intval($idStatus);
        switch ($idStatus) {
            case 0:
                return '[P]';
                break;
            case 1:
                return '[N]';
                break;
            case 2:
                return '[S]';
                break;
            case 3:
                return '[C]';
                break;
            case 4:
                return '🚫';
                break;
            case 5:
                return '✅';
                break;
            case 6:
                return '❗';
                break;
            default:
                return '❗';
        }
    }

    public function formatInterests($idInterest): string
    {
        $interest = ProductCategory::find($idInterest);
        $interestText = "";

        if (isset($interest)) {
            switch ($interest->id) {
                case 1:
                    $interestText = "👕 ";
                    break;
                case 2:
                    $interestText = "🍴 ";
                    break;
                case 3:
                    $interestText = "📰 ";
                    break;
                case 4:
                    $interestText = "🚚 ";
                    break;
                case 5:
                    $interestText = "🖨 ";
                    break;
                case 6:
                    $interestText = "🖼 ";
                    break;
                case 7:
                    $interestText = "💻 ";
                    break;
                case 8:
                    $interestText = "🔖 ";
                    break;
                default:
                    $interestText = "🤷🏾‍♂️ ";
            }

            $interestText .= $interest->category;
            return $interestText;
        }

        $interestText = "No especificado";
        return $interestText;
    }

    public function formatIndustry($industry): string
    {
        //$category = CustomerType::where('id', $customer->type_id)->first();
        $industryText = "";

        if (isset($industry)) {
            switch ($industry->id) {
                case 1:
                    $industryText = "🌮 ";
                    break;
                case 2:
                    $industryText = "⚙ ";
                    break;
                case 3:
                    $industryText = "🦺 ";
                    break;
                case 4:
                    $industryText = "🧹 ";
                    break;
                case 5:
                    $industryText = "🌿 ";
                    break;
                case 6:
                    $industryText = "🚗 ";
                    break;
                case 7:
                    $industryText = "📱 ";
                    break;
                case 8:
                    $industryText = "📖 ";
                    break;
                case 9:
                    $industryText = "🎭 ";
                    break;
                case 10:
                    $industryText = "🏥 ";
                    break;
                case 11:
                    $industryText = "🐶 ";
                    break;
                case 12:
                    $industryText = "⚖ ";
                    break;
                case 13:
                    $industryText = "💵 ";
                    break;
                case 14:
                    $industryText = "🏭 ";
                    break;
                case 15:
                    $industryText = "🛍 ";
                    break;
                case 16:
                    $industryText = "💆‍♀️ ";
                    break;
                case 17:
                    $industryText = "🏡 ";
                    break;
                case 18:
                    $industryText = "⚽ ";
                    break;
                case 19:
                    $industryText = "🛡 ";
                    break;
                case 20:
                    $industryText = "🚕 ";
                    break;
                case 21:
                    $industryText = "⛪ ";
                    break;
                case 22:
                    $industryText = "💎 ";
                    break;
                default:
                    $industryText = "🤷🏾‍♂️ ";
            }

            $industryText .= $industry->type;
            return $industryText;
        }

        $industryText = 'No especificado';

        return $industryText;
    }

    public function mergeArrays($arrayOne, $arrayTwo)
    {
        $array = [];

        foreach ($arrayOne as $valueOne) {
            $status = [];
            foreach ($arrayTwo as $valueTwo) {
                if ($valueTwo->name === $valueOne->name) {
                    array_push($status, $valueTwo);
                }
            }

            $data = [
                'total' => $valueOne->total,
                'name' => $valueOne->name,
                'status' => $status
            ];

            array_push($array, $data);
        }


        return $array;
    }
}

/*

Industrias

*/
