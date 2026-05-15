<?php
// Heading
$_['heading_title']           = '할부';

// Text
$_['text_account']            = '회원정보';
$_['text_recurring']          = '할부정보';
$_['text_recurring_detail']   = '할부상세정보';
$_['text_order_recurring_id'] = '할부번호:';
$_['text_date_added']         = '작성일:';
$_['text_status']             = '상태:';
$_['text_payment_method']     = '결제방법:';
$_['text_order_id']           = '주문번호:';
$_['text_product']            = '상품:';
$_['text_quantity']           = '수량:';
$_['text_description']        = '상세설명';
$_['text_reference']          = '참조';
$_['text_transaction']        = '거래내역';

$_['text_status_1']           = '활성';
$_['text_status_2']           = '비활성';
$_['text_status_3']           = '취소';
$_['text_status_4']           = '일시중지';
$_['text_status_5']           = '만료';
$_['text_status_6']           = '대기 중';

$_['text_transaction_date_added'] = '생성됨';
$_['text_transaction_payment'] = '결제';
$_['text_transaction_outstanding_payment'] = '잔금결제';
$_['text_transaction_skipped'] = '결제 생략됨';
$_['text_transaction_failed'] = '결제 실패함';
$_['text_transaction_cancelled'] = '취소됨';
$_['text_transaction_suspended'] = '일시중지됨';
$_['text_transaction_suspended_failed'] = '결제실패로 일시중지됨';
$_['text_transaction_outstanding_failed'] = '잔금결제 실패함';
$_['text_transaction_expired'] = '만료됨';

$_['text_empty']                 = '할부내역을 찾을 수 없습니다';
$_['text_error']                 = '요청하신 할부주문을 찾을 수 없습니다.';

$_['text_cancelled'] = '할부를 취소했습니다';

/*

		$data['status_types'] = array(
			1 => $this->language->get('text_status_inactive'),
			2 => $this->language->get('text_status_active'),
			3 => $this->language->get('text_status_suspended'),
			4 => $this->language->get('text_status_cancelled'),
			5 => $this->language->get('text_status_expired'),
			6 => $this->language->get('text_status_pending'),
		);

		$data['transaction_types'] = array(
			0 => $this->language->get('text_transaction_date_added'),
			1 => $this->language->get('text_transaction_payment'),
			2 => $this->language->get('text_transaction_outstanding_payment'),
			3 => $this->language->get('text_transaction_skipped'),
			4 => $this->language->get('text_transaction_failed'),
			5 => $this->language->get('text_transaction_cancelled'),
			6 => $this->language->get('text_transaction_suspended'),
			7 => $this->language->get('text_transaction_suspended_failed'),
			8 => $this->language->get('text_transaction_outstanding_failed'),
			9 => $this->language->get('text_transaction_expired'),
		);

			private $recurring_status = array(
		0 => 'Inactive',
		1 => 'Active',
		2 => 'Suspended',
		3 => 'Cancelled',
		4 => 'Expired / Complete'
	);

	private $transaction_type = array(
		0 => 'Created',
		1 => 'Payment',
		2 => 'Outstanding payment',
		3 => 'Payment skipped',
		4 => 'Payment failed',
		5 => 'Cancelled',
		6 => 'Suspended',
		7 => 'Suspended from failed payment',
		8 => 'Outstanding payment failed',
		9 => 'Expired'
	);



*/


// Column
$_['column_date_added']         = '생성됨';
$_['column_type']               = '유형';
$_['column_amount']             = '금액';
$_['column_status']             = '상태';
$_['column_product']            = '상품';
$_['column_order_recurring_id'] = '할부번호';

// Error
$_['error_not_cancelled'] = '오류: %s';
$_['error_not_found']     = '할부를 취소할 수 없습니다';

// Button
$_['button_return']       = '반품';