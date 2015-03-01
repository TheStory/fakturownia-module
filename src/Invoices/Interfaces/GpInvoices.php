<?php

namespace Invoices\Interfaces;

interface GpInvoices {
	
	public function getInvoicesByUserId($iUserId);
	public function getAllInvoices();
	public function getInvoiceById($iInvoiceId);
	public function getCurrentMonthInvoices();
	public function newInvoice();
	public function getClientList();
	public function getClientById($iClientId);
	public function editClientById($iClientId);
	
}