<?php

use App\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\User;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '01227167811',
            'password' => bcrypt('123456789'),
            'email_verified_at' => now()
        ]);
       // $roleAdmin = Role::create(['name' => 'Admin']);
        //$roleUser = Role::create(['name' => 'User']);
        $roleAdmin = Role::where('name', '=', 'Admin')->first();
        $user -> assignRole([$roleAdmin->id]);

//        $cityWithArea=[
//            'Alexandria=الاسكندرية '=>[
//                'Abu Qir#
//Abu Sulaiman#
//Ibrahimia#
//Azarita#
//El islah#
//El hadara#
//El hadara bahrya#
//New el hadara#
//Latin Quarter#
//Miri sand#
//El syouf#
//Shatby#
//El dahrya#
//Amreya#
//Al Ajmi#
//Asafra#
//El Atarin#
//El awayd#
//El kabbari#
//El laban#
//El max#
//El mamoura#
//Al-Maamoura Beach#
//the park#
//Mandara#
//Mansheya#
//El nozha#
//Wardian#
//Bakos#
//bahari#
//Burj Al Arab#
//Bolkly#
//Glim#
//Ganaklis#
//Ras el tin#
//Rushdie#
//Zezenia#
//Saba Pasha#
//San Stefano#
//Sporting#
//Stanley#
//Smouha#
//sidi  beshr ebli#
//Sidi Bishr Mohamed Naguib#
//Sidi Gaber#
//Shoots#
//Gabriel#
//Fleming#
//Victoria#
//Carrefour#
//Camp Caesar#
//karmouz#
//Kafr Abdo#
//Cleopatra#
//Com el dekka#
//King Mariout#
//Lauran#
//Muharram Bey#
//mhatet el raml#
//Mustafa Kamel#
//Miami#
//Mina el basal#
//Wabour el maya
//','أبو قير#
//ابو سليمان#
//الأبراهيمية #
//الازاريطة #
//الاصلاح #
//الحضرة #
//الحضرة البحرية#
//الحضرة الجديدة #
//الحي اللاتيني #
//الرمل الميري #
//السيوف #
//الشاطبي #
//الظاهرية #
//العامرية #
//العجمي #
//العصافرة#
//العطارين #
//العوايد #
//القباري #
//اللبان #
//الماكس#
//المعمورة البلد#
//المعمورة الشاطي #
//المنتزة #
//المندرة #
//المنشية #
//النزهة #
//الورديان#
//باكوس #
//بحري #
//برج العرب#
//بولكلي #
//جليم #
//جناكليس#
//راس التين#
//رشدي #
//زيزينيا #
//سابا باشا#
//سان ستيفانو#
//سبورتينج #
//ستانلي #
//سموحة #
//سيدي بشر قبلي#
//سيدي بشر محمد نجيب#
//سيدي جابر #
//شدس #
//غبريال #
//فلمنج #
//فيكتوريا#
//كارفور #
//كامب شيزار#
//كرموز #
//كفر عبدة#
//كليوبترا #
//كوم الدكة#
//كينج مريوط#
//لوران #
//محرم بك#
//محطة الرمل#
//مصطفي كامل #
//ميامي #
//مينا البصل#
//وابور المياه'],'Cairo=القاهرة'=>['
//6th october#
//Al-Azhar#
//Giza#
//Dokki#
//Zamalek#
//Ms. zainb#
//Abbasiya#
//Agouza#
//New Cairo#
//Smart Village#
//Katameya#
//Maadi#
//Mokattam#
//Manial#
//El mohandsen#
//El nozha el gdeda#
//The pyramids#
//Imbaba#
//garden City#
//Swees bridge#
//October Gardens#
//The Pyramid gardens#
//The Dome Gardens#
//Helwan#
//Shubra#
//Sheikh Zayed#
//Cairo - Alexandria  agricultural road#
//Cairo Alexandria Desert Road#
//Orabi#
//Ain Shams#
//Faisal#
//Rehab City#
//Sherouk City#
//Obour City#
//Nasr City#
//madinati #
//Masaken Sheraton#
//Heliopolis#
//Ancient Egypt#
//downtown','6 أكتوبر #
//الازهر #
//الجيزة #
//الدقي #
//الزمالك #
//السيدة زينب #
//العباسية #
//العجوزة #
//القاهرة الجديدة #
//القرية الذكية #
//القطامية #
//المعادي #
//المقطم #
//المنيل #
//المهندسين #
//النزهة الجديدة #
//الهرم #
//امبابة #
//جاردن سيتي #
//جسر السويس #
//حدائق اكتوبر #
//حدائق الأهرام #
//حدائق القبة #
//حلوان #
//شبرا #
//شيخ زايد #
//طريق القاهرة - اسكندرية #
//طريق القاهرة اسكندرية الصحراوي #
//عرابي #
//عين شمس #
//فيصل #
//مدينة الرحاب #
//مدينة الشروق #
//مدينة العبور #
//مدينة نصر #
//مدينتي #
//مساكن شيراتون #
//مصر الجديدة #
//مصر القديمة #
//وسط البلد
//'],'asyut=اسيوط'=>['Saudi Towers#
//The commercial corridor#
//Al Azhar university#
//26th of July Street#
//Mohamed Tawfiq Street','أبراج السعودية#
//الممر التجاري#
//جامعة الأزهر#
//شارع 26 يوليو#
//شارع محمد توفيق
//'],'Ismailia=الاسماعيلية'=>['El gamiya land#
//El balabsa#
//El blagat#
//El shohada#
//sheikh Zayed#
//The new station#
//Salam District#
//downtown
//','
//ارض الجمعيات#
//البلابسة#
//البلاجات#
//الشهداء#
//الشيخ زايد#
//المحطة الجديدة#
//حي السلام#
//وسط البلد
//'],'Elgona=الجونة'=>['Abu Tig Marina#
//Country#
//Kafr El Gouna
//','ابو تيج مارينا#
//البلد#
//كفر الجونة
//'],
//        ];
//        foreach ($cityWithArea as $key=>$value){
//            $keyArray=explode('=',$key);
//            $city= City::create([
//                'city_name'=>$keyArray[0],
//                'city_name_ar'=>$keyArray[1],
//            ]);
//            $this->createArea($city->id,$value);
//        }
//    }
//    private function createArea($id,$value)
//    {
//        $valueArrayEn=explode('#',$value[0]);
//        $valueArrayAr=explode('#',$value[1]);
//
//        for ($i=0;$i<count($valueArrayEn);$i++){
//            DB::table("areas")->insert([
//                'area_name'=> $valueArrayEn[$i],
//                'area_name_ar'=> $valueArrayAr[$i],
//                'city_id'=>$id,
//                'created_at'=>now()
//            ]);
//        }
    }
}
