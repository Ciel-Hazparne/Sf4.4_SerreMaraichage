<?php

namespace App\Controller;

use App\Entity\Mesures;
use App\Entity\DateSearch;
use App\Form\MesuresType;
use App\Form\DateSearchType;
use App\Repository\MesuresRepository2;
use DateInterval;
use DatePeriod;
use DateTime;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isEmpty;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator

class MesuresController extends AbstractController
{
    /**
     * @Route("/mesures", name="mesures_index", methods={"GET"})
     * @param Request $request
     */
    // public function index(ChartBuilderInterface $chartBuilder,HttpClientInterface $httpClient): Response
    public function index1(ChartBuilderInterface $chartBuilder, MesuresRepository2 $mesuresRepository, Request $request): Response
    {
        //$mesures_temp = $httpClient->request('GET', 'http://127.0.0.1:8001/api/mesures?libelle=temperature_champ')->toArray();
        // $mesures_temp2 = $httpClient->request('GET', 'http://127.0.0.1:8001/api/mesures?libelle=temperature_serre')->toArray();
        // $mesures_humidity2 = $httpClient->request('GET', 'http://127.0.0.1:8001/api/mesures?libelle=humidite_serre')->toArray();
        //$mesures_humidity = $httpClient->request('GET', 'http://127.0.0.1:8001/api/mesures?libelle=humidite_champ')->toArray();
        $mesures_temp = $mesuresRepository->findByLibelleMesures("1");
        $mesures_temp2 = $mesuresRepository->findByLibelleMesures("3");
        $mesures_humidity2 = $mesuresRepository->findByLibelleMesures("4");
        $mesures_humidity = $mesuresRepository->findByLibelleMesures("2");
//        dd($mesures_humidity);

        $labels_humidity = [];
        $labels_humidity2 = [];
        $labels_temperature = [];
        $labels_temperature2 = [];
        $labels_hum = [];
        $labels_hum2 = [];
        $labels_temp = [];
        $labels_temp2 = [];

        $data_temperature = [];
        $data_temperature2 = [];
        $data_humidity = [];
        $data_humidity2 = [];
        $data_hum = [];
        $data_temp = [];
        $data_temp2 = [];
        $data_hum2 = [];

        $searchDateMin = $request->query->get('datemin');
        $searchDateMax = $request->query->get('datemax');
        $dateDuJourMin = date('Y-m-d',strtotime('- 1 day'));
        $dateDuJourMax = date('Y-m-d',strtotime('+ 1 day'));
//      dd($searchDateMin);
        if (isset($_GET["submit1"]))
        {
            ?>
            <script type="text/javascript">
                window.location = "http://127.0.0.1:8000/mesures/courbeByDate?";
            </script>
            <?php
        }

        $data_humidity = $this->getDoctrine()->getRepository(Mesures::class)->findByHumChDateRangeCount(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        $count = $data_humidity[0]["1"];
        foreach ($data_humidity as $i => $value) {
            unset($data_humidity[$i]);
        }
        $data_humidity = $this->getDoctrine()->getRepository(Mesures::class)->findByHumChDateRangeValeur(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        for ($i = 0; $i < $count; $i++) {
            $data_hum[] = $data_humidity[$i]["valeur"];

        }
        $count = 0;
        $labels_humidity = $this->getDoctrine()->getRepository(Mesures::class)->findByHumChDateRangeCount(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        $count = $labels_humidity[0]["1"];
        foreach ($labels_humidity as $i => $value) {
            unset($labels_humidity[$i]);
        }
        $labels_humidity = $this->getDoctrine()->getRepository(Mesures::class)->findByHumChDateRange(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        for ($i = 0; $i < $count; $i++) {
            $labels_hum[] = $labels_humidity[$i]["createdAt"]->format('d/m - H:i');
        }
        $count = 0;


        $chart_humidity = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart_humidity->setData([
            'labels' => $labels_hum,
            'datasets' => [
                [
                    'label' => 'humidité champ',
                    'backgroundColor' => 'rgb(44, 62, 80)',
                    'borderColor' => 'rgb(24, 188, 156)',
                    'data' => $data_hum,

                ],
            ],
        ]);

        $chart_humidity->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => 100]],
                ],
            ],
        ]);

        $data_humidity2 = $this->getDoctrine()->getRepository(Mesures::class)->findByHumSrDateRangeCount(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        $count = $data_humidity2[0]["1"];
        foreach ($data_humidity2 as $i => $value) {
            unset($data_humidity2[$i]);
        }
        $data_humidity2 = $this->getDoctrine()->getRepository(Mesures::class)->findByHumSrDateRangeValeur(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        for ($i = 0; $i < $count; $i++) {
            $data_hum2[] = $data_humidity2[$i]["valeur"];

        }
        $count = 0;
        $labels_humidity2 = $this->getDoctrine()->getRepository(Mesures::class)->findByHumSrDateRangeCount(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        $count = $labels_humidity2[0]["1"];
        foreach ($labels_humidity2 as $i => $value) {
            unset($labels_humidity2[$i]);
        }
        $labels_humidity2 = $this->getDoctrine()->getRepository(Mesures::class)->findByHumSrDateRange(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        for ($i = 0; $i < $count; $i++) {
            $labels_hum2[] = $labels_humidity2[$i]["createdAt"]->format('d/m - H:i');
        }
        $count = 0;

        // humidté serre
        $chart_humidity2 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart_humidity2->setData([
            'labels' => $labels_hum2,
            'datasets' => [
                [
                    'label' => 'humidité serre',
                    'backgroundColor' => 'rgb(44, 62, 80)',
                    'borderColor' => 'rgb(24, 188, 156)',
                    'data' => $data_hum2,

                ],
            ],
        ]);

        $chart_humidity2->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => 100]],
                ],
            ],
        ]);

        $data_temperature = $this->getDoctrine()->getRepository(Mesures::class)->findByTempChDateRangeCount(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        $count = $data_temperature[0]["1"];
        foreach ($data_temperature as $i => $value) {
            unset($data_temperature[$i]);
        }
        $data_temperature = $this->getDoctrine()->getRepository(Mesures::class)->findByTempChDateRangeValeur(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        for ($i = 0; $i < $count; $i++) {
            $data_temp[] = $data_temperature[$i]["valeur"];

        }
        $count = 0;
        $labels_temperature = $this->getDoctrine()->getRepository(Mesures::class)->findByTempChDateRangeCount(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        $count = $labels_temperature[0]["1"];
        foreach ($labels_temperature as $i => $value) {
            unset($labels_temperature[$i]);
        }
        $labels_temperature = $this->getDoctrine()->getRepository(Mesures::class)->findByTempChDateRange(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        for ($i = 0; $i < $count; $i++) {
            $labels_temp[] = $labels_temperature[$i]["createdAt"]->format('d/m - H:i');
        }
        $count = 0;


        $chart_temperature = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart_temperature->setData([
            'labels' => $labels_temp,
            'datasets' => [
                [
                    'label' => 'temperature champ',
                    'backgroundColor' => 'rgb(44, 62, 80)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data_temp,

                ],
            ],
        ]);

        $chart_temperature->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => 100]],
                ],
            ],
        ]);

        $data_temperature2 = $this->getDoctrine()->getRepository(Mesures::class)->findByTempSrDateRangeCount(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        $count = $data_temperature2[0]["1"];
        foreach ($data_temperature2 as $i => $value) {
            unset($data_temperature2[$i]);
        }
        $data_temperature2 = $this->getDoctrine()->getRepository(Mesures::class)->findByTempSrDateRangeValeur(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        for ($i = 0; $i < $count; $i++) {
            $data_temp2[] = $data_temperature2[$i]["valeur"];

        }
        $count = 0;
        $labels_temperature2 = $this->getDoctrine()->getRepository(Mesures::class)->findByTempSrDateRangeCount(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        $count = $labels_temperature2[0]["1"];
        foreach ($labels_temperature2 as $i => $value) {
            unset($labels_temperature2[$i]);
        }
        $labels_temperature2 = $this->getDoctrine()->getRepository(Mesures::class)->findByTempSrDateRange(["createdAt" => $dateDuJourMin], ["createdAt" => $dateDuJourMax]);
        for ($i = 0; $i < $count; $i++) {
            $labels_temp2[] = $labels_temperature2[$i]["createdAt"]->format('d/m - H:i');
        }
        $count = 0;

        // temperature serre
        $chart_temperature2 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart_temperature2->setData([
            'labels' => $labels_temp2,
            'datasets' => [
                [
                    'label' => 'temperature serre',
                    'backgroundColor' => 'rgb(44, 62, 80)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data_temp2,

                ],
            ],
        ]);

//        $chart_humidity->setOptions([
//            'scales' => [
//                'yAxes' => [
//                    ['ticks' => ['min' => 0, 'max' => 100]],
//                ],
//            ],
//        ]);

//        if() $request->query->get('submit');

        return $this->render('mesures/index.html.twig', [
            'current_menu' => 'mesures',
            'chart1' => $chart_humidity,
            'chart2' => $chart_temperature,
            'chart3' => $chart_humidity2,
            'chart4' => $chart_temperature2
        ]);
    }

    /**
     * @Route("/mesures/delete/{id}",name="mesures_delete", methods={"DELETE"})
     * @param Request $request
     * @param Mesures $mesure
     * @return RedirectResponse
     */
    public function delete(Request $request, Mesures $mesure): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mesure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mesure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mesures_tab');
    }
    /**
     * @Route("/mesures/tab", name="mesures_tab", methods={"GET"})
     * @param Request $request
     * @param MesuresRepository2 $mesuresRepository
     * @return Response
     */
    public function index(Request $request,MesuresRepository2 $mesuresRepository,  PaginatorInterface $paginator): Response
    {
        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
        $donnees = $this->getDoctrine()->getRepository(Mesures::class)->findBy([],['createdAt' => 'asc']);

        $mesuresP = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );
        if (isset($_GET["submit2"]))
        {
            ?>
            <script type="text/javascript">
                window.location = "http://127.0.0.1:8000/mesures/tabByDate";
            </script>
            <?php
        }
        $mesures = $mesuresRepository->findAll();
        return $this->render('mesures/tab.html.twig', ['current_menu' => 'mesures', 'mesures' => $mesures, 'mesures' => $mesuresP]);
    }

    /**
     * @Route("/mesures/tabByDate", name="mesures_tabByDate", methods={"GET"})
     * @param Request $request
     * @param MesuresRepository2 $mesuresRepository
     * @return Response
     */
    public function tabByDate(Request $request,MesuresRepository2 $mesuresRepository, PaginatorInterface $paginator): Response
    {

        $searchDateMin = $request->query->get('datemin');
        $searchDateMax = $request->query->get('datemax');


        // $mesures = $paginator->paginate($mesuresRepository->findAll(),$request->query->getInt('page',1),4);
//        $mesures = $mesuresRepository->findAll();
        if($searchDateMin == null) {
            $donnees = $this->getDoctrine()->getRepository(Mesures::class)->findBy([],['id' => 'asc']);
            $mesuresP = $paginator->paginate(
                $donnees, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                10 // Nombre de résultats par page
            );
            $mesures = $mesuresRepository->findAll();
            return $this->render('mesures/tabByDate.html.twig', ['current_menu' => 'mesures', 'mesures' => $mesures,'mesures' => $mesuresP]);
        }
        $donneesId = $mesuresRepository->findByDate(["createdAt" => $searchDateMin],["createdAt" => $searchDateMax]);
//        dd($donneesId);
        $donneesIdMin= min($donneesId);
        $donneesIdMax= max($donneesId);
        $donnees = $mesuresRepository->findById(["id" => $donneesIdMin],["id" => $donneesIdMax]);

        $mesuresP = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );
        $mesuresId = $mesuresRepository->findByDate(["createdAt" => $searchDateMin],["createdAt" => $searchDateMax]);
        $mesuresIdMin= min($mesuresId);
        $mesuresIdMax= max($mesuresId);
        $mesures = $mesuresRepository->findById(["id" => $mesuresIdMin],["id" => $mesuresIdMax]);
//        dd($mesures);
        return $this->render('mesures/tabByDate.html.twig', ['current_menu' => 'mesures', 'mesures' => $mesures,'mesures' => $mesuresP]);
    }

    /**
     * @Route("/mesures/courbeByDate", name="mesures_courbe_By_Date", methods={"GET"})
     * @param Request $request
     */
    public function index2(ChartBuilderInterface $chartBuilder, MesuresRepository2 $mesuresRepository, Request $request): Response
    {
        $labels_hum = [];
        $labels_hum2 = [];
        $labels_temp = [];
        $labels_temp2 = [];

        $data_hum = [];
        $data_temp = [];
        $data_temp2 = [];
        $data_hum2 = [];

        $searchDateMin = $request->query->get('datemin');
        $searchDateMax = $request->query->get('datemax');

        $data_humidity = $this->getDoctrine()->getRepository(Mesures::class)->findByHumChDateRangeCount(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        $count = $data_humidity[0]["1"];
        foreach ($data_humidity as $i => $value) {
            unset($data_humidity[$i]);
        }
        $data_humidity = $this->getDoctrine()->getRepository(Mesures::class)->findByHumChDateRangeValeur(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        for ($i = 0; $i < $count; $i++) {
            $data_hum[] = $data_humidity[$i]["valeur"];

        }
        $count = 0;
        $labels_humidity = $this->getDoctrine()->getRepository(Mesures::class)->findByHumChDateRangeCount(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        $count = $labels_humidity[0]["1"];
        foreach ($labels_humidity as $i => $value) {
            unset($labels_humidity[$i]);
        }
        $labels_humidity = $this->getDoctrine()->getRepository(Mesures::class)->findByHumChDateRange(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        for ($i = 0; $i < $count; $i++) {
            $labels_hum[] = $labels_humidity[$i]["createdAt"]->format('d/m - H:i');
        }
        $count = 0;

        // humidté champ
        $chart_humidity = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart_humidity->setData([
            'labels' => $labels_hum,
            'datasets' => [
                [
                    'label' => 'humidité champ',
                    'backgroundColor' => 'rgb(44, 62, 80)',
                    'borderColor' => 'rgb(24, 188, 156)',
                    'data' => $data_hum,

                ],
            ],
        ]);

        $chart_humidity->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => 100]],
                ],
            ],
        ]);

        $data_humidity2 = $this->getDoctrine()->getRepository(Mesures::class)->findByHumSrDateRangeCount(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        $count = $data_humidity2[0]["1"];
        foreach ($data_humidity2 as $i => $value) {
            unset($data_humidity2[$i]);
        }
        $data_humidity2 = $this->getDoctrine()->getRepository(Mesures::class)->findByHumSrDateRangeValeur(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        for ($i = 0; $i < $count; $i++) {
            $data_hum2[] = $data_humidity2[$i]["valeur"];

        }
        $count = 0;
        $labels_humidity2 = $this->getDoctrine()->getRepository(Mesures::class)->findByHumSrDateRangeCount(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        $count = $labels_humidity2[0]["1"];
        foreach ($labels_humidity2 as $i => $value) {
            unset($labels_humidity2[$i]);
        }
        $labels_humidity2 = $this->getDoctrine()->getRepository(Mesures::class)->findByHumSrDateRange(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        for ($i = 0; $i < $count; $i++) {
            $labels_hum2[] = $labels_humidity2[$i]["createdAt"]->format('d/m - H:i');
        }
        $count = 0;

        // humidté serre
        $chart_humidity2 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart_humidity2->setData([
            'labels' => $labels_hum2,
            'datasets' => [
                [
                    'label' => 'humidité serre',
                    'backgroundColor' => 'rgb(44, 62, 80)',
                    'borderColor' => 'rgb(24, 188, 156)',
                    'data' => $data_hum2,

                ],
            ],
        ]);

        $chart_humidity2->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => 100]],
                ],
            ],
        ]);

        $data_temperature = $this->getDoctrine()->getRepository(Mesures::class)->findByTempChDateRangeCount(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        $count = $data_temperature[0]["1"];
        foreach ($data_temperature as $i => $value) {
            unset($data_temperature[$i]);
        }
        $data_temperature = $this->getDoctrine()->getRepository(Mesures::class)->findByTempChDateRangeValeur(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        for ($i = 0; $i < $count; $i++) {
            $data_temp[] = $data_temperature[$i]["valeur"];

        }
        $count = 0;
        $labels_temperature = $this->getDoctrine()->getRepository(Mesures::class)->findByTempChDateRangeCount(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        $count = $labels_temperature[0]["1"];
        foreach ($labels_temperature as $i => $value) {
            unset($labels_temperature[$i]);
        }
        $labels_temperature = $this->getDoctrine()->getRepository(Mesures::class)->findByTempChDateRange(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        for ($i = 0; $i < $count; $i++) {
            $labels_temp[] = $labels_temperature[$i]["createdAt"]->format('d/m - H:i');
        }
        $count = 0;

        // temperature champ
        $chart_temperature = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart_temperature->setData([
            'labels' => $labels_temp,
            'datasets' => [
                [
                    'label' => 'temperature champ',
                    'backgroundColor' => 'rgb(44, 62, 80)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data_temp,

                ],
            ],
        ]);

        $chart_temperature->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => 100]],
                ],
            ],
        ]);

        $data_temperature2 = $this->getDoctrine()->getRepository(Mesures::class)->findByTempSrDateRangeCount(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        $count = $data_temperature2[0]["1"];
        foreach ($data_temperature2 as $i => $value) {
            unset($data_temperature2[$i]);
        }
        $data_temperature2 = $this->getDoctrine()->getRepository(Mesures::class)->findByTempSrDateRangeValeur(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        for ($i = 0; $i < $count; $i++) {
            $data_temp2[] = $data_temperature2[$i]["valeur"];

        }
        $count = 0;
        $labels_temperature2 = $this->getDoctrine()->getRepository(Mesures::class)->findByTempSrDateRangeCount(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        $count = $labels_temperature2[0]["1"];
        foreach ($labels_temperature2 as $i => $value) {
            unset($labels_temperature2[$i]);
        }
        $labels_temperature2 = $this->getDoctrine()->getRepository(Mesures::class)->findByTempSrDateRange(["createdAt" => $searchDateMin], ["createdAt" => $searchDateMax]);
        for ($i = 0; $i < $count; $i++) {
            $labels_temp2[] = $labels_temperature2[$i]["createdAt"]->format('d/m - H:i');
        }
        $count = 0;

        // temperature serre
        $chart_temperature2 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart_temperature2->setData([
            'labels' => $labels_temp2,
            'datasets' => [
                [
                    'label' => 'temperature serre',
                    'backgroundColor' => 'rgb(44, 62, 80)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data_temp2,

                ],
            ],
        ]);

        $chart_humidity->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => 100]],
                ],
            ],
        ]);

        return $this->render('mesures/courbeByDate.html.twig', [
            'current_menu' => 'mesures',
            'chart1' => $chart_humidity,
            'chart2' => $chart_temperature,
            'chart3' => $chart_humidity2,
            'chart4' => $chart_temperature2
        ]);

    }
//    /**
//     * @Route("/mesures/pagination", name="mesures_page")
//     */
//    public function mesuresPagination(Request $request, PaginatorInterface $paginator) // Nous ajoutons les paramètres requis
//    {
//        // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
//        $donnees = $this->getDoctrine()->getRepository(Mesures::class)->findBy([],['createdAt' => 'asc']);
//
//        $mesures = $paginator->paginate(
//            $donnees, // Requête contenant les données à paginer (ici nos articles)
//            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
//            6 // Nombre de résultats par page
//        );
//
//        return $this->render('mesures/tab.html.twig', [
//            'mesures' => $mesures,
//        ]);
//    }
}