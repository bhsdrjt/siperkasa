/**
 *	Neon Register Script
 *
 *	Developed by Arlind Nushi - www.laborator.co
 */
var neonRegister = neonRegister || {};
(function($, window, undefined)
{
	"use strict";
	$(document).ready(function()
	{
		neonRegister.$container = $("#form_register");	
		neonRegister.$steps = neonRegister.$container.find(".form-steps");
		neonRegister.$steps_list = neonRegister.$steps.find(".step");
		neonRegister.step = 'step-1'; // current step

		neonRegister.$container.validate({
			
				
			rules: {
				setuju: {
					required: true
				},
				nama: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
					minlength: 6
				},
				ktp: {
					required: true,
					rangelength: [16, 16]
				},
				hp: {
					required: true,
					
				},
				alamat: {
					required: true,	
				},
				kota: {
					required: true,
					
				},
				usia: {
					required: true,
				},
				konfirmasipassword: {
					required: true,
					equalTo: "#password"
				},
				jeniskelamin: {
					required: true
				},
			},
			messages: {
				nama: {
					required: 'Nama harus diisi'
				},
				email: {
					required: 'Email harus diisi',
					email: 'Format email salah'
				},
				password: {
					required: 'password harus diisi',
					minlength: 'Panjang karakter minimal 6 karakter.'
				},
				ktp: {
					required: 'Nomor KTP harus diisi',
					rangelength: 'Panjang karakter harus 16 karakter.'
				},
				hp: {
					required: 'Nomor HP harus diisi',
					
				},
				alamat: {
					required: 'alamat harus diisi',	
				},
				kota: {
					required: 'Kota harus diisi',
					
				},
				usia: {
					required: 'Usia harus diisi',
				},
				konfirmasipassword: {
					required: 'Konfirmasi Password harus diisi',
					equalTo: "Konfirmasi Password harus sama dengan Password"
				},
				jeniskelamin: {
					required: 'Pilih salah satu',
				},
				setuju: {
					required: '<span style="color:#d64e44">&nbsp (*harus dicentang)</span>',
				},
			},
			highlight: function(element) {
				$(element).closest('.input-group').addClass('validate-has-error');
			},
			unhighlight: function(element)
			{
				$(element).closest('.input-group').removeClass('validate-has-error');
			},
		});
		// Steps Handler
		neonRegister.$steps.find('[data-step]').on('click', function(ev)
		{
			ev.preventDefault();
			var $current_step = neonRegister.$steps_list.filter('.current'),
				next_step = $(this).data('step'),
				validator = neonRegister.$container.data('validator'),
				errors = 0;
			neonRegister.$container.valid();
			errors = validator.numberOfInvalids()
			if(errors)
			{
				validator.focusInvalid();
			}
			else
			{ 
				var $next_step = neonRegister.$steps_list.filter('#' + next_step),
					$other_steps = neonRegister.$steps_list.not( $next_step ),
					
					current_step_height = $current_step.data('height'),
					next_step_height = $next_step.data('height');
				
				TweenMax.set(neonRegister.$steps, {css: {height: current_step_height}});
				TweenMax.to(neonRegister.$steps, 0.6, {css: {height: next_step_height}});
				
				TweenMax.to($current_step, .3, {css: {autoAlpha: 0}, onComplete: function()
				{
					$current_step.attr('style', '').removeClass('current');
					
					var $form_elements = $next_step.find('.form-group');
					
					TweenMax.set($form_elements, {css: {autoAlpha: 0}});
					$next_step.addClass('current');
					
					$form_elements.each(function(i, el)
					{
						var $form_element = $(el);
						
						TweenMax.to($form_element, .2, {css: {autoAlpha: 1}, delay: i * .09});
					});
					
					setTimeout(function()
					{
						$form_elements.add($next_step).add($next_step).attr('style', '');
						$form_elements.first().find('input').focus();
						
					}, 1000 * (.5 + ($form_elements.length - 1) * .09));
				}});

				

			}
		});
		
		neonRegister.$steps_list.each(function(i, el)
		{
			var $this = $(el),
				is_current = $this.hasClass('current'),
				margin = 20;
			
			if(is_current)
			{
				$this.data('height', $this.outerHeight() + margin);
			}
			else
			{
				$this.addClass('current').data('height', $this.outerHeight() + margin).removeClass('current');
			}
		});
		

		// Login Form Setup
		neonRegister.$body = $(".login-page");
		neonRegister.$login_progressbar_indicator = $(".login-progressbar-indicator h3");
		neonRegister.$login_progressbar = neonRegister.$body.find(".login-progressbar div");
		neonRegister.$login_progressbar_indicator.html('0%');
		if(neonRegister.$body.hasClass('login-form-fall'))
		{
			var focus_set = false;
			setTimeout(function(){ 
				neonRegister.$body.addClass('login-form-fall-init')
				setTimeout(function()
				{
					if( !focus_set)
					{
						neonRegister.$container.find('input:first').focus();
						focus_set = true;
					}
				}, 550);
			}, 0);
		}
		else
		{
			neonRegister.$container.find('input:first').focus();
		}
		



	});
})(jQuery, window);