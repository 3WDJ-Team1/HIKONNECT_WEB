<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
/**
 * Controller class for Mountain's Information
 *
 * @category Controllers
 * @package  App
 * @author   Sol Song <thdthf159@naver.com>
 * @license  MIT license
 * @link     https://github.com/3WDJ-Team1/HIKONNECT_WEB
 */
class MountainController extends Controller
{
    private $mnt_id;

    public function mountain_info(Request $request) {
        $ch = curl_init();
        $url = 'http://apis.data.go.kr/1400000/service/cultureInfoService/mntInfoOpenAPI'; /*URL*/
        $queryParams = '?' . urlencode('ServiceKey') . '=eJyhIAgcErLmIPd2uJfFv%2FaKNe3esQ3P56iisSP7lak%2FHZtaFYfJNqJh%2FW%2BmX5Kp3w%2BFlA%2B5Cumz2P%2FTTbSM6g%3D%3D'; /*Service Key*/
        $queryParams .= '&' . urlencode('searchWrd') . '=' . urlencode($request->get('mnt_name')); /**/

        curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        $result = json_encode(new \SimpleXMLElement($response));
        $arr = json_decode($result,true);
        curl_close($ch);

        return response()->json($arr);
    }
    
    public function mnt_image(Request $request) {
        $ch = curl_init();
        $url = 'http://apis.data.go.kr/1400000/service/cultureInfoService/mntInfoOpenAPI'; /*URL*/
        $queryParams = '?' . urlencode('ServiceKey') . '=eJyhIAgcErLmIPd2uJfFv%2FaKNe3esQ3P56iisSP7lak%2FHZtaFYfJNqJh%2FW%2BmX5Kp3w%2BFlA%2B5Cumz2P%2FTTbSM6g%3D%3D'; /*Service Key*/
        $queryParams .= '&' . urlencode('searchWrd') . '=' . urlencode($request->get('mnt_name')); /**/

        curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        $result = json_encode(new \SimpleXMLElement($response));
        $arr1 = json_decode($result,true);
        if (isset($arr1['body']['items']['item'][0]['mntilistno'])) {
            $this->mnt_id = $arr1['body']['items']['item'][1]['mntilistno'];
        } else
            $this->mnt_id = $arr1['body']['items']['item']['mntilistno'];
        /////////////////////////////////////////////////////////////////////
        $ch = curl_init();
        $url = 'http://apis.data.go.kr/1400000/service/cultureInfoService/mntInfoImgOpenAPI'; /*URL*/
        $queryParams = '?' . urlencode('ServiceKey') . '=eJyhIAgcErLmIPd2uJfFv%2FaKNe3esQ3P56iisSP7lak%2FHZtaFYfJNqJh%2FW%2BmX5Kp3w%2BFlA%2B5Cumz2P%2FTTbSM6g%3D%3D'; /*Service Key*/
        $queryParams .= '&' . urlencode('mntiListNo') . '=' . urlencode($this->mnt_id); /*목록에서 조회된 산정보코드*/

        curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        $result = json_encode(new \SimpleXMLElement($response));
        $arr = json_decode($result,true);
        curl_close($ch);
        /*$arr['body']['items']['item']*/
        return response()->json($arr);
    }

    /**
     * @funtion     tour
     * @brief       Process of Login to App
     *
     * @param \Illuminate\Http\Request $request
     *         string id
     *         string pw
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function tour(Request $request) {
        $ch = curl_init();
        $url = 'http://api.visitkorea.or.kr/openapi/service/rest/KorService/locationBasedList'; /*URL*/
        $queryParams = '?' . urlencode('ServiceKey') . '=eJyhIAgcErLmIPd2uJfFv%2FaKNe3esQ3P56iisSP7lak%2FHZtaFYfJNqJh%2FW%2BmX5Kp3w%2BFlA%2B5Cumz2P%2FTTbSM6g%3D%3D'; /*Service Key*/
        $queryParams .= '&' . urlencode('ServiceKey') . '=' . urlencode('eJyhIAgcErLmIPd2uJfFv%2FaKNe3esQ3P56iisSP7lak%2FHZtaFYfJNqJh%2FW%2BmX5Kp3w%2BFlA%2B5Cumz2P%2FTTbSM6g%3D%3D'); /*공공데이터포털에서 발급받은 인증키*/
        $queryParams .= '&' . urlencode('numOfRoews') . '=' . urlencode('20'); /*한 페이지 결과 수*/
        $queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /*현재 페이지 번호*/
        $queryParams .= '&' . urlencode('MobileOS') . '=' . urlencode('ETC'); /*IOS(아이폰),AND(안드로이드),WIN(원도우폰), ETC*/
        $queryParams .= '&' . urlencode('MobileApp') . '=' . urlencode('AppTest'); /*서비스명=어플명*/
        $queryParams .= '&' . urlencode('arrange') . '=' . urlencode('A'); /*(A=제목순,B=조회순,C=수정일순,D=생성일순) 대표이미지가 반드시 있는 정렬 (O=제목순, P=조회순, Q=수정일순, R=생성일순)*/
        $queryParams .= '&' . urlencode('contenTypeId') . '=' . urlencode('15'); /*관광타입(관광지, 숙박 등) ID*/
        $queryParams .= '&' . urlencode('mapX') . '=' . urlencode($request->get('longitude')); /*GPS X좌표(WGS84 경도 좌표)*/
        $queryParams .= '&' . urlencode('mapY') . '=' . urlencode($request->get('latitude')); /*GPS Y좌표(WGS84 위도 좌표)*/
        $queryParams .= '&' . urlencode('radius') . '=' . urlencode('10000'); /*거리 반경(단위m), Max값 20000m=20Km*/
        $queryParams .= '&' . urlencode('listYN') . '=' . urlencode('Y'); /*목록 구분 (Y=목록, N=개수)*/

        curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        $result = json_encode(new \SimpleXMLElement($response));
        $arr = json_decode($result,true);
        curl_close($ch);

        return response()->json($arr);
    }
}
