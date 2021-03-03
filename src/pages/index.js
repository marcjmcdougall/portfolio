import React from "react"
import { graphql, Link } from 'gatsby'
import LayoutStandard from '../components/layouts/Standard'


export default function Home() {

  return (

  		<LayoutStandard>

	  		<section className="row">

	  			<div className="col-7">

	  				<h1>I design websites that turn <span className="accent">traffic into customers</span>.</h1>
	  				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

	  			</div>

	  			<div className="col-5">



	  			</div>

	  		</section>

	  		<section id="work-sample" className="row">

	  			<div className="col-12">

	  				<h2 className="label">Recent Work <Link to="/portfolio" className="float-right fancy-link">See All My Work</Link></h2>

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

  		</LayoutStandard>
  	)
}

export const query = graphql`
	
	query siteInfo {

	  site {

	    siteMetadata {

	      description
	      title
	    }
	  }
	}

`
