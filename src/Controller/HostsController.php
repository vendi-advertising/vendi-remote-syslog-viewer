<?php

namespace App\Controller;

use App\Constants\SyslogFacilities;
use App\Constants\SyslogPriorities;
use App\Repository\SyslogEventRepository;
use App\Service\MessageFilterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class HostsController extends AbstractController
{
    private $syslogEventRepository;
    private $messageFilterService;

    public function __construct(SyslogEventRepository $syslogEventRepository, MessageFilterService $messageFilterService)
    {
        $this->syslogEventRepository = $syslogEventRepository;
        $this->messageFilterService = $messageFilterService;
    }

    /**
     * @Route("/hosts", name="hosts")
     */
    public function index()
    {
        $hosts = $this
            ->syslogEventRepository
            ->getAllUniqueHostsHashed()
        ;

        return $this->render('hosts/index.html.twig', [
            'hosts' => $hosts,
        ]);
    }

    /**
     * @Route("/hosts/{hostname}", name="single_host_info", requirements={"hostname"=".+"})
     */
    public function host_details(string $hostname, Request $request)
    {

        $hosts = $this
            ->syslogEventRepository
            ->getAllUniqueHostsHashed()
        ;

        $host_hash = $request->query->get('host');
        if(!$host_hash){
            throw new \Exception('No host hash');
        }

        if(!array_key_exists($host_hash, $hosts)){
            throw new \Exception('Host hash doesn\'t match known hosts');
        }

        $hostname = $hosts[$host_hash];

        $criteria = [
            'FromHost' => $hostname,
        ];

        $facilities = $request->query->get('facility');
        if($facilities){
            $facilities = array_values($facilities);
        }else{
            $facilities = [];
        }

        $priorities = $request->query->get('priority');
        if($priorities){
            $priorities = array_values($priorities);
        }else{
            $priorities = [0, 1, 2, 3, 4];
        }

        $selected_options = $request->query->get('options');
        if($selected_options){
            $selected_options = array_values($selected_options);
        }else{
            $selected_options = ['filter_messages'];
        }

        if(count($facilities)){
            $criteria['Facility'] = $facilities;
        }
        if(count($priorities)){
            $criteria['Priority'] = $priorities;
        }

        $events = $this->syslogEventRepository->findBy($criteria);

        if(in_array('filter_messages', $selected_options)){
            $this->messageFilterService->apply_filters($events);
        }

        return $this->render('hosts/single_host_info.html.twig', [
            'events' => $events,
            'hosts' => $hosts,
            'all_facilities' => SyslogFacilities::get_all(),
            'all_priorities' => SyslogPriorities::get_all(),
            'selected_facilities' => array_values($facilities),
            'selected_priorities' => array_values($priorities),
            'selected_options' => $selected_options,
            'host_hash' => $host_hash,
        ]);
    }
}
