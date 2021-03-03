import React from "react"
import { Link } from 'gatsby'
import LayoutStandard from '../../components/layouts/Standard' 

export default function Portfolio() {
	
  return (

  		<LayoutStandard>

	  		<section className="row">

	  			<div className="col-7">

	  				<h1>Portfolio</h1>
	  				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

	  			</div>

	  		</section>

	  		<section className="row archive-container">

	  			<div className="col-4 col-6-md archive-portfolio">

	  				<img src="./portfolio/wr-preview-compressed.jpg"/>
	  				<h3>Wink Reports</h3>
	  				<p>Wink Reports was getting a ton of traffic, though only a handful of demo requests each month. I came in and tightened up their messaging 😎</p>
	  				<a href="/" className="fancy-link">Read More</a>

	  			</div>

	  			<div className="col-4 col-6-md archive-portfolio">

	  				<img src="./portfolio/safesend-preview-compressed.jpg"/>
	  				<h3>SafeSend Software</h3>
	  				<p>Wink Reports was getting a ton of traffic, though only a handful of demo requests each month. I came in and tightened up their messaging 😎</p>
	  				<a href="/" className="fancy-link">Read More</a>

	  			</div>

	  			<div className="col-4 col-6-md archive-portfolio">

	  				<img src="./portfolio/cointree-overview-compressed.jpg"/>

	  				<h3>Cointree</h3>
	  				<p>Wink Reports was getting a ton of traffic, though only a handful of demo requests each month. I came in and tightened up their messaging 😎</p>
	  				<a href="/" className="fancy-link">Read More</a>

	  			</div>

	  			<div className="col-4 col-6-md archive-portfolio">

	  				<img src="./portfolio/wr-preview-compressed.jpg"/>
	  				<h3>Wink Reports</h3>
	  				<p>Wink Reports was getting a ton of traffic, though only a handful of demo requests each month. I came in and tightened up their messaging 😎</p>
	  				<a href="/" className="fancy-link">Read More</a>

	  			</div>

	  			<div className="col-4 col-6-md archive-portfolio">

	  				<img src="./portfolio/safesend-preview-compressed.jpg"/>
	  				<h3>SafeSend Software</h3>
	  				<p>Wink Reports was getting a ton of traffic, though only a handful of demo requests each month. I came in and tightened up their messaging 😎</p>
	  				<a href="/" className="fancy-link">Read More</a>

	  			</div>

	  			<div className="col-4 col-6-md archive-portfolio">

	  				<img src="./portfolio/cointree-overview-compressed.jpg"/>

	  				<h3>Cointree</h3>
	  				<p>Wink Reports was getting a ton of traffic, though only a handful of demo requests each month. I came in and tightened up their messaging 😎</p>
	  				<a href="/" className="fancy-link">Read More</a>

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
