<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inventory;
use App\Models\Organization;
use App\Models\Site;
use App\Models\EquipmentType;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get organizations
        $polda = Organization::where('code', 'POLDA_JBI')->first();
        $bidTik = Organization::where('code', 'BID_TIK')->first();
        $satBrimob = Organization::where('code', 'SAT_BRIMOB')->first();
        $ditlantas = Organization::where('code', 'LANTAS')->first();
        $ditsabhara = Organization::where('code', 'SABHARA')->first();
        $ditintelkam = Organization::where('code', 'INTELKAM')->first();
        $ditreskrimum = Organization::where('code', 'RESKRIMUM')->first();
        $ditreskrimsus = Organization::where('code', 'RESKRIMSUS')->first();
        $ditresnarkoba = Organization::where('code', 'RESNARKOB')->first();
        $ditpamobvit = Organization::where('code', 'PAMOBVIT')->first();
        $ditpolair = Organization::where('code', 'POLAIR')->first();
        
        $polrestaJambi = Organization::where('code', 'RESTA_JBI')->first();
        $polresMuaroJambi = Organization::where('code', 'RES_MUARO')->first();
        $polresTanjabBarat = Organization::where('code', 'RES_TAJAB')->first();
        $polresTanjabTimur = Organization::where('code', 'RES_TAJAT')->first();
        $polresBatanghari = Organization::where('code', 'RES_BATANG')->first();
        $polresSarolangun = Organization::where('code', 'RES_SAROLA')->first();
        $polresMerangin = Organization::where('code', 'RES_MERANG')->first();
        $polresBungo = Organization::where('code', 'RES_BUNGO')->first();
        $polresTebo = Organization::where('code', 'RES_TEBO')->first();
        $polresKerinci = Organization::where('code', 'RES_KERIN')->first();

        // Get sites
        $sitePolda = Site::where('name', 'Site Polda Jambi')->first();
        $sitePolsektaKotabaru = Site::where('name', 'Site Polsekta Kotabaru')->first();
        $siteBrimob1 = Site::where('name', 'Site Brimob 1')->first();
        $siteBrimob2 = Site::where('name', 'Site Brimob 2')->first();

        // Fallback to first site if specific sites not found
        $defaultSite = Site::first();
        $sitePolda = $sitePolda ?? $defaultSite;
        $sitePolsektaKotabaru = $sitePolsektaKotabaru ?? $defaultSite;
        $siteBrimob1 = $siteBrimob1 ?? $defaultSite;
        $siteBrimob2 = $siteBrimob2 ?? $defaultSite;

        // Skip seeding if no sites available
        if (!$defaultSite) {
            $this->command->warn('No sites found. Skipping inventory seeding.');
            return;
        }

        // Get equipment types
        $gtr8000 = EquipmentType::where('name', 'GTR8000')->first();
        $gtr800 = EquipmentType::where('name', 'GTR800')->first();
        $mx800 = EquipmentType::where('name', 'MX800')->first();
        $mtr3000 = EquipmentType::where('name', 'MTR3000')->first();
        $quantar = EquipmentType::where('name', 'QUANTAR')->first();
        $kenwood = EquipmentType::where('name', 'KENWOOD REPEATER')->first();
        $msoTrunking = EquipmentType::where('name', 'MSO TRUNKING')->first();
        
        $radioFixed = EquipmentType::where('name', 'CDM1250')->first();
        $radioMobile = EquipmentType::where('name', 'XTL2500 MOBILE')->first();
        
        $xts2500 = EquipmentType::where('name', 'XTS2500')->first();
        $xts5000 = EquipmentType::where('name', 'XTS5000')->first();
        $apx6000 = EquipmentType::where('name', 'APX6000')->first();
        $apx7000 = EquipmentType::where('name', 'APX7000')->first();
        $apx8000 = EquipmentType::where('name', 'APX8000')->first();
        $cp1300 = EquipmentType::where('name', 'CP1300')->first();
        $cp1660 = EquipmentType::where('name', 'CP1660')->first();
        $gp328 = EquipmentType::where('name', 'GP328')->first();
        $gp338 = EquipmentType::where('name', 'GP338')->first();
        $cp200 = EquipmentType::where('name', 'CP200')->first();
        $lexL11 = EquipmentType::where('name', 'LEX L11')->first();

        $ccgwRouter = EquipmentType::where('name', 'CCGW ROUTER')->first();
        $vpnRouter = EquipmentType::where('name', 'VPN ROUTER')->first();
        $rgu = EquipmentType::where('name', 'RGU')->first();

        // POLDA JAMBI Equipment
        Inventory::create([
            'organization_id' => $polda->id,
            'site_id' => $sitePolda->id,
            'equipment_type_id' => $gtr800->id,
            'installation_year' => 2013,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'GTR800 + MSO TRUNKING',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $polda->id,
            'site_id' => $sitePolda->id,
            'equipment_type_id' => $msoTrunking->id,
            'installation_year' => 2013,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'MSO TRUNKING System',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $polda->id,
            'site_id' => $sitePolda->id,
            'equipment_type_id' => $gtr8000->id,
            'installation_year' => 2024,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'KOMOB RPT GTR8000',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $polda->id,
            'site_id' => $sitePolda->id,
            'equipment_type_id' => $gtr8000->id,
            'installation_year' => 2024,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'KOMOB RPT 8X800',
            'is_active' => true,
        ]);

        // KAPOLDA & WAKAPOLDA Equipment
        Inventory::create([
            'organization_id' => $polda->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2020,
            'condition' => 'BB',
            'quantity' => 2,
            'notes' => 'XTL2500 untuk Kapolda & Wakapolda',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $polda->id,
            'equipment_type_id' => $xts2500->id, 
            'installation_year' => 2020,
            'condition' => 'BB',
            'quantity' => 2,
            'notes' => 'XTS2500 untuk Kapolda & Wakapolda',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $polda->id,
            'equipment_type_id' => $lexL11->id,
            'installation_year' => 2024,
            'condition' => 'BB',
            'quantity' => 2,
            'notes' => 'LEX 11 Android untuk Kapolda & Wakapolda',
            'is_active' => true,
        ]);

        // SAT BRIMOB Equipment
        Inventory::create([
            'organization_id' => $satBrimob->id,
            'site_id' => $siteBrimob1->id,
            'equipment_type_id' => $gtr8000->id,
            'installation_year' => 2015,
            'condition' => 'BB',
            'quantity' => 3,
            'notes' => 'GTR8000 Repeater Brimob',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $satBrimob->id,
            'site_id' => $siteBrimob2->id,
            'equipment_type_id' => $mx800->id,
            'installation_year' => 2010,
            'condition' => 'RR',
            'quantity' => 3,
            'notes' => 'MX800 Repeater Brimob',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $satBrimob->id,
            'equipment_type_id' => $radioFixed->id,
            'installation_year' => 2015,
            'condition' => 'BB',
            'quantity' => 11,
            'notes' => 'Radio Fixed Brimob',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $satBrimob->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2015,
            'condition' => 'BB',
            'quantity' => 8,
            'notes' => 'Radio Mobile Brimob',
            'is_active' => true,
        ]);

        // Brimob HT distribution
        Inventory::create([
            'organization_id' => $satBrimob->id,
            'equipment_type_id' => $xts2500->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 50,
            'notes' => 'XTS2500 Brimob',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $satBrimob->id,
            'equipment_type_id' => $apx7000->id,
            'installation_year' => 2020,
            'condition' => 'BB',
            'quantity' => 80,
            'notes' => 'APX7000 Brimob',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $satBrimob->id,
            'equipment_type_id' => $cp1660->id,
            'installation_year' => 2019,
            'condition' => 'BB',
            'quantity' => 100,
            'notes' => 'CP1660 Brimob',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $satBrimob->id,
            'equipment_type_id' => $gp328->id,
            'installation_year' => 2015,
            'condition' => 'BB',
            'quantity' => 89,
            'notes' => 'GP328 Brimob',
            'is_active' => true,
        ]);

        // BID TIK Equipment - Repeater
        Inventory::create([
            'organization_id' => $bidTik->id,
            'site_id' => $sitePolda->id,
            'equipment_type_id' => $gtr8000->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 15,
            'notes' => 'GTR8000 Trunking & Konvensional BID TIK',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $bidTik->id,
            'equipment_type_id' => $mx800->id,
            'installation_year' => 2012,
            'condition' => 'RR',
            'quantity' => 6,
            'notes' => 'MX800 Konvensional BID TIK',
            'is_active' => true,
        ]);

        // BID TIK Radio Fixed
        Inventory::create([
            'organization_id' => $bidTik->id,
            'equipment_type_id' => $radioFixed->id,
            'installation_year' => 2017,
            'condition' => 'BB',
            'quantity' => 19,
            'notes' => 'Radio Fixed BID TIK',
            'is_active' => true,
        ]);

        // BID TIK Radio Mobile
        Inventory::create([
            'organization_id' => $bidTik->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2017,
            'condition' => 'BB',
            'quantity' => 53,
            'notes' => 'Radio Mobile BID TIK',
            'is_active' => true,
        ]);

        // BID TIK HT
        Inventory::create([
            'organization_id' => $bidTik->id,
            'equipment_type_id' => $xts2500->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 120,
            'notes' => 'XTS2500 BID TIK',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $bidTik->id,
            'equipment_type_id' => $apx7000->id,
            'installation_year' => 2020,
            'condition' => 'BB',
            'quantity' => 80,
            'notes' => 'APX7000 BID TIK',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $bidTik->id,
            'equipment_type_id' => $cp1660->id,
            'installation_year' => 2019,
            'condition' => 'BB',
            'quantity' => 38,
            'notes' => 'CP1660 BID TIK',
            'is_active' => true,
        ]);

        // BID TIK Router
        Inventory::create([
            'organization_id' => $bidTik->id,
            'equipment_type_id' => $ccgwRouter->id,
            'installation_year' => 2020,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'CCGW Router BID TIK',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $bidTik->id,
            'equipment_type_id' => $vpnRouter->id,
            'installation_year' => 2020,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'VPN Router BID TIK',
            'is_active' => true,
        ]);

        // DITLANTAS Equipment
        Inventory::create([
            'organization_id' => $ditlantas->id,
            'equipment_type_id' => $radioFixed->id,
            'installation_year' => 2016,
            'condition' => 'BB',
            'quantity' => 6,
            'notes' => 'Radio Fixed Lantas',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditlantas->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2016,
            'condition' => 'BB',
            'quantity' => 16,
            'notes' => 'Radio Mobile Lantas',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditlantas->id,
            'equipment_type_id' => $xts2500->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 150,
            'notes' => 'XTS2500 Lantas',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditlantas->id,
            'equipment_type_id' => $apx7000->id,
            'installation_year' => 2020,
            'condition' => 'BB',
            'quantity' => 80,
            'notes' => 'APX7000 Lantas',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditlantas->id,
            'equipment_type_id' => $cp1660->id,
            'installation_year' => 2019,
            'condition' => 'BB',
            'quantity' => 62,
            'notes' => 'CP1660 Lantas',
            'is_active' => true,
        ]);

        // DITSABHARA Equipment
        Inventory::create([
            'organization_id' => $ditsabhara->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2017,
            'condition' => 'BB',
            'quantity' => 3,
            'notes' => 'Radio Mobile Sabhara',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditsabhara->id,
            'equipment_type_id' => $xts2500->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 80,
            'notes' => 'XTS2500 Sabhara',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditsabhara->id,
            'equipment_type_id' => $cp1660->id,
            'installation_year' => 2019,
            'condition' => 'BB',
            'quantity' => 58,
            'notes' => 'CP1660 Sabhara',
            'is_active' => true,
        ]);

        // DITINTELKAM Equipment
        Inventory::create([
            'organization_id' => $ditintelkam->id,
            'equipment_type_id' => $radioFixed->id,
            'installation_year' => 2016,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'Radio Fixed Intelkam',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditintelkam->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2016,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'Radio Mobile Intelkam',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditintelkam->id,
            'equipment_type_id' => $xts2500->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 24,
            'notes' => 'XTS2500 Intelkam',
            'is_active' => true,
        ]);

        // DITRESKRIMUM Equipment
        Inventory::create([
            'organization_id' => $ditreskrimum->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2017,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'Radio Mobile Reskrimum',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditreskrimum->id,
            'equipment_type_id' => $xts2500->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 49,
            'notes' => 'XTS2500 Reskrimum',
            'is_active' => true,
        ]);

        // DITRESKRIMSUS Equipment
        Inventory::create([
            'organization_id' => $ditreskrimsus->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2017,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'Radio Mobile Reskrimsus',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditreskrimsus->id,
            'equipment_type_id' => $xts2500->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 38,
            'notes' => 'XTS2500 Reskrimsus',
            'is_active' => true,
        ]);

        // DITRESNARKOBA Equipment
        Inventory::create([
            'organization_id' => $ditresnarkoba->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2017,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'Radio Mobile Resnarkoba',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditresnarkoba->id,
            'equipment_type_id' => $xts2500->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 37,
            'notes' => 'XTS2500 Resnarkoba',
            'is_active' => true,
        ]);

        // DITPAMOBVIT Equipment
        Inventory::create([
            'organization_id' => $ditpamobvit->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2017,
            'condition' => 'BB',
            'quantity' => 2,
            'notes' => 'Radio Mobile Pamobvit',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditpamobvit->id,
            'equipment_type_id' => $xts2500->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 67,
            'notes' => 'XTS2500 Pamobvit',
            'is_active' => true,
        ]);

        // DITPOLAIR Equipment
        Inventory::create([
            'organization_id' => $ditpolair->id,
            'equipment_type_id' => $radioFixed->id,
            'installation_year' => 2016,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'Radio Fixed Polair',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditpolair->id,
            'equipment_type_id' => $radioMobile->id,
            'installation_year' => 2016,
            'condition' => 'BB',
            'quantity' => 1,
            'notes' => 'Radio Mobile Polair',
            'is_active' => true,
        ]);

        Inventory::create([
            'organization_id' => $ditpolair->id,
            'equipment_type_id' => $xts2500->id,
            'installation_year' => 2018,
            'condition' => 'BB',
            'quantity' => 70,
            'notes' => 'XTS2500 Polair',
            'is_active' => true,
        ]);

        // POLRESTA JAMBI Equipment
        $this->createPolresEquipment($polrestaJambi, $sitePolsektaKotabaru, [
            'repeater' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]],
            'radio_fixed' => ['quantity' => 13, 'condition_mix' => ['BB' => 13]],
            'radio_mobile' => ['quantity' => 22, 'condition_mix' => ['BB' => 22]],
            'ht' => ['quantity' => 554, 'condition_mix' => ['BB' => 554]],
            'rgu' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]]
        ]);

        // POLRES MUARO JAMBI Equipment  
        $this->createPolresEquipment($polresMuaroJambi, null, [
            'repeater' => ['quantity' => 4, 'condition_mix' => ['BB' => 3, 'RR' => 1]],
            'radio_fixed' => ['quantity' => 12, 'condition_mix' => ['BB' => 12]],
            'radio_mobile' => ['quantity' => 12, 'condition_mix' => ['BB' => 12]],
            'ht' => ['quantity' => 285, 'condition_mix' => ['BB' => 285]],
            'router' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]]
        ]);

        // POLRES TANJAB BARAT Equipment
        $this->createPolresEquipment($polresTanjabBarat, null, [
            'repeater' => ['quantity' => 2, 'condition_mix' => ['BB' => 2]],
            'radio_fixed' => ['quantity' => 12, 'condition_mix' => ['BB' => 12]],
            'radio_mobile' => ['quantity' => 12, 'condition_mix' => ['BB' => 12]],
            'ht' => ['quantity' => 237, 'condition_mix' => ['BB' => 237]],
            'router' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]]
        ]);

        // POLRES TANJAB TIMUR Equipment
        $this->createPolresEquipment($polresTanjabTimur, null, [
            'repeater' => ['quantity' => 2, 'condition_mix' => ['BB' => 2]],
            'radio_fixed' => ['quantity' => 15, 'condition_mix' => ['BB' => 15]],
            'radio_mobile' => ['quantity' => 21, 'condition_mix' => ['BB' => 21]],
            'ht' => ['quantity' => 257, 'condition_mix' => ['BB' => 257]],
            'router' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]]
        ]);

        // POLRES BATANGHARI Equipment
        $this->createPolresEquipment($polresBatanghari, null, [
            'repeater' => ['quantity' => 4, 'condition_mix' => ['BB' => 2, 'RR' => 1, 'RB' => 1]],
            'radio_fixed' => ['quantity' => 13, 'condition_mix' => ['BB' => 13]],
            'radio_mobile' => ['quantity' => 19, 'condition_mix' => ['BB' => 19]],
            'ht' => ['quantity' => 249, 'condition_mix' => ['BB' => 249]],
            'router' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]]
        ]);

        // POLRES SAROLANGUN Equipment
        $this->createPolresEquipment($polresSarolangun, null, [
            'repeater' => ['quantity' => 3, 'condition_mix' => ['BB' => 3]],
            'radio_fixed' => ['quantity' => 12, 'condition_mix' => ['BB' => 12]],
            'radio_mobile' => ['quantity' => 14, 'condition_mix' => ['BB' => 14]],
            'ht' => ['quantity' => 291, 'condition_mix' => ['BB' => 291]],
            'router' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]]
        ]);

        // POLRES MERANGIN Equipment
        $this->createPolresEquipment($polresMerangin, null, [
            'repeater' => ['quantity' => 3, 'condition_mix' => ['BB' => 2, 'RR' => 1]],
            'radio_fixed' => ['quantity' => 9, 'condition_mix' => ['BB' => 9]],
            'radio_mobile' => ['quantity' => 15, 'condition_mix' => ['BB' => 15]],
            'ht' => ['quantity' => 268, 'condition_mix' => ['BB' => 268]],
            'router' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]],
            'rgu' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]]
        ]);

        // POLRES BUNGO Equipment
        $this->createPolresEquipment($polresBungo, null, [
            'repeater' => ['quantity' => 6, 'condition_mix' => ['BB' => 4, 'RR' => 1, 'RB' => 1]],
            'radio_fixed' => ['quantity' => 14, 'condition_mix' => ['BB' => 14]],
            'radio_mobile' => ['quantity' => 18, 'condition_mix' => ['BB' => 18]],
            'ht' => ['quantity' => 303, 'condition_mix' => ['BB' => 303]],
            'router' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]],
            'rgu' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]]
        ]);

        // POLRES TEBO Equipment
        $this->createPolresEquipment($polresTebo, null, [
            'repeater' => ['quantity' => 5, 'condition_mix' => ['BB' => 3, 'RR' => 1, 'RB' => 1]],
            'radio_fixed' => ['quantity' => 16, 'condition_mix' => ['BB' => 16]],
            'radio_mobile' => ['quantity' => 23, 'condition_mix' => ['BB' => 23]],
            'ht' => ['quantity' => 268, 'condition_mix' => ['BB' => 268]],
            'router' => ['quantity' => 2, 'condition_mix' => ['BB' => 2]]
        ]);

        // POLRES KERINCI Equipment
        $this->createPolresEquipment($polresKerinci, null, [
            'repeater' => ['quantity' => 2, 'condition_mix' => ['BB' => 2]],
            'radio_fixed' => ['quantity' => 11, 'condition_mix' => ['BB' => 11]],
            'radio_mobile' => ['quantity' => 20, 'condition_mix' => ['BB' => 20]],
            'ht' => ['quantity' => 239, 'condition_mix' => ['BB' => 239]],
            'router' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]],
            'rgu' => ['quantity' => 1, 'condition_mix' => ['BB' => 1]]
        ]);
    }

    private function createPolresEquipment($organization, $site, $equipmentData)
    {
        $gtr8000 = EquipmentType::where('name', 'GTR8000')->first();
        $radioFixed = EquipmentType::where('name', 'CDM1250')->first();
        $radioMobile = EquipmentType::where('name', 'XTL2500 MOBILE')->first();
        $xts2500 = EquipmentType::where('name', 'XTS2500')->first();
        $apx7000 = EquipmentType::where('name', 'APX7000')->first();
        $cp1660 = EquipmentType::where('name', 'CP1660')->first();
        $ccgwRouter = EquipmentType::where('name', 'CCGW ROUTER')->first();
        $rgu = EquipmentType::where('name', 'RGU')->first();

        // Create repeater equipment
        if (isset($equipmentData['repeater'])) {
            foreach ($equipmentData['repeater']['condition_mix'] as $condition => $quantity) {
                if ($quantity > 0) {
                    Inventory::create([
                        'organization_id' => $organization->id,
                        'site_id' => $site?->id,
                        'equipment_type_id' => $gtr8000->id,
                        'installation_year' => 2016,
                        'condition' => $condition,
                        'quantity' => $quantity,
                        'notes' => "Repeater {$organization->name} - {$condition}",
                        'is_active' => true,
                    ]);
                }
            }
        }

        // Create radio fixed equipment
        if (isset($equipmentData['radio_fixed'])) {
            foreach ($equipmentData['radio_fixed']['condition_mix'] as $condition => $quantity) {
                if ($quantity > 0) {
                    Inventory::create([
                        'organization_id' => $organization->id,
                        'equipment_type_id' => $radioFixed->id,
                        'installation_year' => 2017,
                        'condition' => $condition,
                        'quantity' => $quantity,
                        'notes' => "Radio Fixed {$organization->name} - {$condition}",
                        'is_active' => true,
                    ]);
                }
            }
        }

        // Create radio mobile equipment
        if (isset($equipmentData['radio_mobile'])) {
            foreach ($equipmentData['radio_mobile']['condition_mix'] as $condition => $quantity) {
                if ($quantity > 0) {
                    Inventory::create([
                        'organization_id' => $organization->id,
                        'equipment_type_id' => $radioMobile->id,
                        'installation_year' => 2017,
                        'condition' => $condition,
                        'quantity' => $quantity,
                        'notes' => "Radio Mobile {$organization->name} - {$condition}",
                        'is_active' => true,
                    ]);
                }
            }
        }

        // Create HT equipment with variety
        if (isset($equipmentData['ht'])) {
            $totalHT = $equipmentData['ht']['quantity'];
            $htTypes = [
                ['type' => $xts2500, 'percentage' => 0.4],
                ['type' => $apx7000, 'percentage' => 0.35],
                ['type' => $cp1660, 'percentage' => 0.25]
            ];

            foreach ($htTypes as $htType) {
                $quantity = intval($totalHT * $htType['percentage']);
                if ($quantity > 0) {
                    Inventory::create([
                        'organization_id' => $organization->id,
                        'equipment_type_id' => $htType['type']->id,
                        'installation_year' => 2018,
                        'condition' => 'BB',
                        'quantity' => $quantity,
                        'notes' => "HT {$organization->name}",
                        'is_active' => true,
                    ]);
                }
            }
        }

        // Create router equipment
        if (isset($equipmentData['router'])) {
            foreach ($equipmentData['router']['condition_mix'] as $condition => $quantity) {
                if ($quantity > 0) {
                    Inventory::create([
                        'organization_id' => $organization->id,
                        'equipment_type_id' => $ccgwRouter->id,
                        'installation_year' => 2020,
                        'condition' => $condition,
                        'quantity' => $quantity,
                        'notes' => "Router {$organization->name} - {$condition}",
                        'is_active' => true,
                    ]);
                }
            }
        }

        // Create RGU equipment
        if (isset($equipmentData['rgu'])) {
            foreach ($equipmentData['rgu']['condition_mix'] as $condition => $quantity) {
                if ($quantity > 0) {
                    Inventory::create([
                        'organization_id' => $organization->id,
                        'equipment_type_id' => $rgu->id,
                        'installation_year' => 2019,
                        'condition' => $condition,
                        'quantity' => $quantity,
                        'notes' => "RGU {$organization->name} - {$condition}",
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
