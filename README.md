<p align="center"><a href="https://sirdiagnostico.com.br" target="_blank"><img src="https://sirdiagnostico.com.br/images/logoSIR.png" width="100"></a></p>

<p align="center">
<img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
</p>

## About SIR Diagnóstico Website

This website was made to SIR Diagnóstico, which is a company from Brazil that works with MRI, tomography, x-ray and ultrasound. What was done:

- A clean institutional page with informations about service portfolio and the branches, with address and link to Waze and Uber.
- A simple integration with the company's [TOTVS RM](https://produtos.totvs.com/ficha-tecnica/tudo-sobre-o-totvs-rh-linha-rm/) ERP using SOAP to collect data from exams.
- The generation of a link with a security token to PACS user view from [Carestream](https://www.carestream.com/en/us/), where the patient could se the exam results.
- A WhatsApp integration using [Botgesigner](https://botdesigner.io/) to send the link to view the exam results.


## How it works

I implement a exam query task every hour to retrieve exams with available status to generate a link to view the result and send to patient's WhatsApp.

## Thanks

This project was built using [Laravel 8.0](https://laravel.com/). I would like to thank the whole laravel community.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
