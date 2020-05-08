<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Регистрация - Osminog.bet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Регистрация - Osminog.bet">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="/landing/main.css" rel="stylesheet">
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow">
    <div class="app-container">
        <div class="h-100">
            <div class="h-100 no-gutters row">
                <div class="h-100 d-md-flex d-sm-block bg-white justify-content-center align-items-center col-md-12 col-lg-7">
                    <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                        <div class="app-logo"></div>
                        <h4>
                            <div>Добро пожаловать,</div>
                            <span>Пожалуйста, создайте свой <span class="text-success">аккаунт</span>.</span>
                        </h4>
                        <div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleFirstName" class=""><span class="text-danger">*</span> Имя</label>
                                            <input name="name" id="exampleFirstName" placeholder="Имя..." type="text" class="form-control" value="{{ old('name') }}" required>
                                        </div>
                                        @error('name')
                                        <span class="" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleLastName" class=""><span class="text-danger">*</span>Фамилия</label>
                                            <input name="surname" id="exampleLastName" placeholder="Фамилия..." type="text" class="form-control" value="{{ old('surname') }}" required>
                                        </div>
                                        @error('surname')
                                        <span class="" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail" class=""><span class="text-danger">*</span> Email</label>
                                            <input name="email" id="exampleEmail" placeholder="Email..." type="email" class="form-control" value="{{ old('email') }}" required>
                                        </div>
                                        @error('email')
                                        <span class="" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="examplePhone" class=""><span class="text-danger">*</span> Телефон</label>
                                            <input name="phone" id="examplePhone" placeholder="Телефон..." type="tel" class="form-control" value="{{ old('phone') }}" required>
                                        </div>
                                        @error('phone')
                                        <span class="" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="examplePassword" class=""><span class="text-danger">*</span> Пароль</label>
                                            <input name="password" id="examplePassword" placeholder="Пароль..." type="password" class="form-control" value="{{ old('password') }}" required>
                                        </div>
                                        @error('password')
                                        <span class="" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="examplePasswordRep" class=""><span class="text-danger">*</span> Повторите пароль</label>
                                            <input name="password_confirmation"  id="password-confirm" placeholder="Повторите пароль..." type="password" class="form-control">
                                        </div>
                                        @error('password_confirmation')
                                        <span class="" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="exampleTelegram" class=""><span class="text-danger">*</span> Telegram</label>
                                            <input name="telegram" id="exampleTelegram" placeholder="Telegram..." type="text" class="form-control" value="{{ old('telegram') }}" required>
                                        </div>
                                        @error('telegram')
                                        <span class="" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3 position-relative form-check">
                                    <div>
                                        <input name="confirm" id="exampleCheck" type="checkbox" class="form-check-input">
	                                    <label for="exampleCheck" class="form-check-label">Я принимаю Ваши <a href="javascript:void(0);" data-toggle="modal" data-target="#termsAndConditions">Условия использования</a>.</label>
                                    </div>
                                    @error('confirm')
                                    <span class="" role="alert">
                                                    <strong>вы должны принять условия использования</strong>
                                                </span>
                                    @enderror
                                </div>
                                <div class="mt-4 d-flex align-items-center">
                                    <h5 class="mb-0">Уже есть аккаунт? <a href="{{ route('login') }}" class="text-primary">Войти</a></h5>
                                    <div class="ml-auto">
                                        <button class="btn-wide btn-pill btn-shadow btn-hover-shine btn btn-primary btn-lg">Создать аккаунт</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-5">
                    <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                        <div class="slide-img-bg" style="background-image: url('assets/images/citynights.jpg');"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal "Terms and Conditions" -->
<div class="modal fade" id="termsAndConditions" tabindex="-1" role="dialog" aria-labelledby="termsAndConditionsTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsAndConditionsTitle">Пользовательское соглашение</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<p>Настоящее Соглашение определяет условия использования программного обеспечения (далее – ПО) Пользователями данного ПО.</p>
				<h5 class="text-center">Термины и определения</h5>
				<p>В целях настоящего Соглашения применяются следующие термины и определения:</p>
				<ul class="list-unstyled">
					<li>1) Программное обеспечение (ПО) - программа для ЭВМ «Осьминог бот». Правообладателем ПО является администрация Сайта (далее - Компания).</li>
					<li>2) Пользователи ПО – лица, использующие ПО на основании настоящего Соглашения.</li>
					<li>3) Сайт - информационная система, определенная сетевым адресом: <a href="http://osminog.bet/" target="_blank">http://osminog.bet/</a>. Реквизиты Компании указаны на Сайте.</li>
				</ul>
				<h5 class="text-center">1. Предмет Соглашения</h5>
				<ul class="list-unstyled">
					<li>1.1. Компания предоставляет Пользователю неисключительное право использования ПО (простая неисключительная лицензия). Без предоставления Пользователю прав заключения сублицензионных договоров (соглашений).</li>
					<li>1.2. ПО предназначено для – получения Пользователями информации, об арбитражных ситуациях в спорте и коэффициентах ставок в букмекерских организациях. Информация, предоставляемая Пользователю, носит исключительно информационный характер и не гарантирует получения заработка в каком-либо виде.</li>
					<li>1.3. Для обеспечения возможности нормального использования ПО Пользователидолжны иметь:
						<ul>
							<li>процессор не ниже класса i5 2.3;</li>
							<li>оперативная память не менее 8 гб;</li>
							<li>операционную систему Windows 7 или более новая;</li>
							<li>доступ в Интернет со скоростью соединения не ниже 50 мбит/с.</li>
						</ul>
					</li>
					<li>1.4. Передача прав на использования ПО осуществляется путем скачивания ПО по активной ссылке, размещенной на Сайте.</li>
					<li>1.5. Установка ПО производится Пользователем самостоятельно.</li>
					<li>1.6. Обязательства Компании по настоящему Соглашению считаются исполненными с момента предоставление Пользователю активной ссылки для скачивая ПО.</li>
				</ul>
				<h5 class="text-center">2. Обязательства Пользователя</h5>
				<ul class="list-unstyled">
					<li>2.1. Использовать ПО в соответствии с условиями, указанными в настоящем Соглашении.</li>
					<li>2.2. Уплачивать Компании вознаграждение за пользование ПО.</li>
					<li>2.3. Не предоставлять права пользования ПО третьим лицам.</li>
					<li>2.4. Самостоятельно нести ответственность за последствия принимаемых решений на основе данных полученных в результате использования ПО.</li>
				</ul>
				<h5 class="text-center">3. Стоимость и порядок расчетов</h5>
				<ul class="list-unstyled">
					<li>3.1. Стоимость использования ПО указана на Сайте.</li>
					<li>3.2. Пользователь оплачивает стоимость предоставления ПО на условиях 100% предоплаты путем безналичного перечисления денежных средств по реквизитам, указанным на Сайте.</li>
					<li>3.3. Компания вправе в одностороннем порядке изменять стоимость использования ПО, путем публикации соответствующей информации на Сайте, при этом новая стоимость вступает в силу только по истечении срока уже оплаченного доступа к ПО.</li>
					<li>3.4. Соглашение действует при условии полной оплаты Пользователем стоимости ПО.</li>
					<li>3.5. Право пользование ПО считается оплаченным, а Соглашение считается заключенным в момент поступления денежных средств на счет Компании.</li>
				</ul>
				<h5 class="text-center">4. Ответственность Сторон</h5>
				<ul class="list-unstyled">
					<li>4.1. Компания не несет ответственности за соответствие ожиданиям, представлениям и требованиям Пользователя содержания полученной им информации в результате использования ПО.</li>
					<li>4.2. Компания не несет ответственности за последствия решений, принятых Пользователем на основании информации, полученной в ходе Использования ПО.</li>
					<li>4.3. Компания не несет ответственности перед Пользователем за качество и стабильность работы сети интернет, электросетей, качество работы программного обеспечения, предоставляемого сторонними организациями.</li>
					<li>4.4. Компания не несет ответственности за возникшие у Пользователя проблемы технического и иного характера, в том числе проблемы с интернет-провайдером, неполадки в работе программного обеспечения, проблемы с отсутствием знаний в пользовании ПК, отсутствие программного обеспечения и технических устройств необходимых для оказания услуги, противоправные действия третьих лиц, иные сбои технического оборудования Пользователя.</li>
				</ul>
				<h5 class="text-center">5. Срок действия Соглашения</h5>
				<ul class="list-unstyled">
					<li>5.1. Настоящее Соглашение вступает в силу с момента поступления на счет Компании полной оплаты Пользователем стоимости использования ПО, и действует до полного исполнения Сторонами своих обязательств.</li>
					<li>5.2. Соглашение считается незаключенным в том случае, если оплата поступает в размере, меньшем установленной Компанией стоимости.</li>
				</ul>
				<h5 class="text-center">6. Обстоятельства непреодолимой силы</h5>
				<ul class="list-unstyled">
					<li>6.1. Стороны освобождаются от ответственности за неисполнение или ненадлежащее исполнение обязательств по Соглашению, если это вызвано действием обстоятельства непреодолимой силы, о которых Стороны не могли заранее знать или не могли их преодолеть.</li>
					<li>6.2. Выполнение обязательств по настоящему Соглашению частично или в полном объеме приостанавливается на время действия обстоятельств непреодолимой силы. Если действие форс-мажорных обстоятельств длится более 3-х месяцев – Соглашение считается расторгнутым.</li>
				</ul>
				<h5 class="text-center">7. Обработка персональных данных</h5>
				<ul class="list-unstyled">
					<li>7.1. Под обработкой персональных данных Пользователя (субъекта персональных данных) понимаются действия Компании с персональными данными, включая сбор, систематизацию, накопление, хранение, уточнение (обновление, изменение), использование, распространение (в том числе передачу), обезличивание, блокирование, уничтожение персональных данных.</li>
					<li>7.2. Целью предоставления Пользователем персональных данных и последующей обработки их Компанией является исполнения Компанией настоящего Соглашения.</li>
					<li>7.3. Компания, по истечении предусмотренных действующим законодательством сроков хранения документов, содержащих персональные данные, обеспечивает их уничтожение. Согласие Пользователя на обработку персональных данных действует с момента их предоставления и действует по истечении срока, указанного в настоящем пункте, либо прекращается по письменному заявлению в свободной форме.</li>
					<li>7.4. Пользователь выражает согласие на получение информации обо всех проводимых Компанией мероприятиях и прочей информации, в том числе рекламы, независимо от срока действия настоящего Соглашения.</li>
				</ul>
				<h5 class="text-center">8. Прочие условия</h5>
				<ul class="list-unstyled">
					<li>8.1. Компания вправе проводить планово-профилактические работы, которые могут повлечь перерывы в работе ПО.</li>
					<li>8.2. Во всех остальных вопросах, возникающих в связи с настоящим Соглашением, но прямо не урегулированных им, Стороны руководствуются действующим законодательством Российской Федерации.</li>
					<li>8.3. Стороны согласились считать конфиденциальной информацию, полученную Сторонами при исполнении настоящего Соглашения и отнесенную какой-либо из Сторон к конфиденциальной. Конфиденциальная информация не подлежит разглашению третьим лицам за исключением случаев, предусмотренных законодательством Российской Федерации.</li>
					<li>8.4. Стороны обязуются действовать добросовестно и предпринимать все меры к разрешению всех споров и разногласий путем переговоров. При разрешении споров, возникших в процессе исполнения Соглашения, для Сторон обязателен досудебный претензионный порядок урегулирования спора. Срок рассмотрения претензии составляет 30 (тридцать) календарных дней с момента получения претензионного письма.</li>
					<li>8.5. Заключая настоящее Соглашение, Пользователь выражает свое полное и безоговорочное согласие со всеми его условиями, подтверждает свою дееспособность, а также Пользователь подтверждает, что настоящие условия не ущемляют его прав и законных интересов.</li>
					<li>8.6. Настоящий Договор является договором присоединения в соответствии со статьей 428 ГК РФ. Настоящий Договор не является публичным договором в смысле статьи 426 Гражданского кодекса Российской Федерации. Компания оставляет за собой право отказать пользователю по своему усмотрению в заключении настоящего Договора.</li>
				</ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal "Terms and Conditions" -->

<script type="text/javascript" src="/assets/scripts/main.js"></script></body>
</html>
