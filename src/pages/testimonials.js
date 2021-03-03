import React from "react"
import { Link } from 'gatsby'
import LayoutStandard from '../components/layouts/Standard'

export default function Testimonials() {

  return (

  		<LayoutStandard>

	  		<section className="row">

	  			<div className="col-7">

	  				<h1>Testimonials</h1>
	  				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>

	  			</div>

	  		</section>

	  		<section className="row archive-container">

	  			<div className="col-6 archive-testimonial">

	  				<p>[…] Having the external perspective is incredibly valuable and we have already made changes to our site thanks to him. If you aren’t getting conversions from your website at the level you want, Marc’s your man.</p>

	  				<img src="/testimonials/james-warrack.jpg"/>

	  				<div className="text-content">
	  					<h3>James Warrack</h3>
	  					<p>SaveTrees Online Timesheets</p>
	  				</div>

	  			</div>

	  			<div className="col-6 archive-testimonial">

	  				<p>[…] Having the external perspective is incredibly valuable and we have already made changes to our site thanks to him. If you aren’t getting conversions from your website at the level you want, Marc’s your man.</p>

	  				<img src="/testimonials/jon-mcgoh.jpg"/>

	  				<div className="text-content">
	  					<h3>Jon McGoh</h3>
	  					<p>SaveTrees Online Timesheets</p>
	  				</div>

	  			</div>

	  			<div className="col-6 archive-testimonial">

	  				<p>[…] Having the external perspective is incredibly valuable and we have already made changes to our site thanks to him. If you aren’t getting conversions from your website at the level you want, Marc’s your man.</p>

	  				<img src="/testimonials/alec-hogg.jpg"/>

	  				<div className="text-content">
	  					<h3>Alec Hogg</h3>
	  					<p>SaveTrees Online Timesheets</p>
	  				</div>

	  			</div>

	  			<div className="col-6 archive-testimonial">

	  				<p>[…] Having the external perspective is incredibly valuable and we have already made changes to our site thanks to him. If you aren’t getting conversions from your website at the level you want, Marc’s your man.</p>

	  				<img src="/testimonials/johann-dutoit.jpg"/>

	  				<div className="text-content">
	  					<h3>Johann DuToit</h3>
	  					<p>SaveTrees Online Timesheets</p>
	  				</div>

	  			</div>

	  			<div className="col-6 archive-testimonial">

	  				<p>[…] Having the external perspective is incredibly valuable and we have already made changes to our site thanks to him. If you aren’t getting conversions from your website at the level you want, Marc’s your man.</p>

	  				<img src="/testimonials/nick-gray.jpg"/>

	  				<div className="text-content">
	  					<h3>Nick Gray</h3>
	  					<p>SaveTrees Online Timesheets</p>
	  				</div>

	  			</div>

	  			<div className="col-6 archive-testimonial">

	  				<p>[…] Having the external perspective is incredibly valuable and we have already made changes to our site thanks to him. If you aren’t getting conversions from your website at the level you want, Marc’s your man.</p>

	  				<img src="/testimonials/james-warrack.jpg"/>

	  				<div className="text-content">
	  					<h3>James Warrack</h3>
	  					<p>SaveTrees Online Timesheets</p>
	  				</div>

	  			</div>

	  		</section>

	  		<section className="row pagination">

	  			<div className="col-8">
	  			
		  			<ul>

						<li><Link className="current" to="#">1</Link></li>
						<li><Link to="#">2</Link></li>
						<li><Link to="#">3</Link></li>
						<li><Link to="#">4</Link></li>

					</ul>

				</div>

	  		</section>

  		</LayoutStandard>
  	)
}
