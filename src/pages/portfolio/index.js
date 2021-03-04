import React from "react"
import { Link, graphql } from 'gatsby'
import LayoutStandard from '../../components/layouts/Standard' 

export default function Portfolio({ data }) {
	
  return (

  		<LayoutStandard>

	  		<section className="row">

	  			<div className="col-7">

	  				<h1>Portfolio</h1>
	  				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

	  			</div>

	  		</section>

	  		<section className="row archive-container">

	  			{data.allWpPost.nodes.map(node => (

	  			<div className="col-4 col-6-md archive-portfolio">

	  				<Link to={node.slug}><img src="./portfolio/wr-preview-compressed.jpg"/></Link>
	  				<h3>{node.title}</h3>
	  				<p dangerouslySetInnerHTML={{ __html: node.excerpt }}></p>
	  				<Link to={node.slug} className="fancy-link">Read More</Link>

	  			</div>

	  			))}

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

export const pageQuery = graphql`
  query {
    allWpPost(sort: { fields: [date] }) {
      nodes {
        title
        excerpt
        slug
      }
    }
  }
`