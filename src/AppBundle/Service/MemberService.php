<?php

namespace AppBundle\Service;

class MemberService 
{

	private $memberRepository;
  private $em;

	public function __construct($memberRepository, $entityManager) {
		$this->memberRepository = $memberRepository; 
    $this->em = $entityManager; 
	}

	public function findMemberById($id) {
		return $this->memberRepository->findOneById($id);
	}

} //End class