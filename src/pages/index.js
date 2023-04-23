import React, {useEffect} from "react"
import { graphql, Link } from 'gatsby'
import Img from "gatsby-image"
import BackgroundImage from 'gatsby-background-image'
import LayoutStandard from '../components/layouts/Standard'
import me from '../img/home/me-cutout.png';


export default function Home({ data }) {

	const localFiles = data.allFile.nodes;

	useEffect(() => {

		console.log('hiiiiiii');


	}, [])

  return (

  		<LayoutStandard>

	  		<section id="homepage-hero" className="row vcenter">

		  		<div className="container">

		  			<div className="col-7 text-content">

		  				<h1>Design that actually drives <span className="accent">business results.</span></h1>
		  				<p>I design simple, customer-centric interfaces to help SaaS companies activate more users & minimize churn.</p>
		  				<div className="cta-wrapper">

		  					<a className="accent button" href="/">Let's Talk</a>
		  					<a className="button" href="/portfolio">See My Work</a>

		  				</div>

		  			</div>

		  			<div className="col-5 hidden-sm">

		  				<div className="homepage-img-wrapper">

			  				<div className="homepage-img">

			  					<div className="statistic statistic-3">
			  							
			  							<div className="text">
				  							<label>Weekly Active Users</label>
				  							<p className="h4">1,347</p>
			  							</div>

			  							<div className="delta">+ 122</div>

			  					</div>

			  					<div className="statistic statistic-2">
			  							
			  							<div className="text">
				  							<label>Session Duration</label>
				  							<p className="h4">1m 23s</p>
			  							</div>

			  							<div className="delta">+ 9s</div>

			  					</div>

			  					<img src={me} alt="Me!" />

			  					<div className="statistic statistic-1">
			  							
			  							<div className="text">
				  							<label>Trial Conversions</label>
				  							<p className="h4">459</p>
			  							</div>

			  							<div className="delta">+ 14</div>

			  					</div>

			  					{/*<Img fluid={localFiles.find(n => n.name == 'me-full').childImageSharp.fluid}/>*/}

			  				</div>

		  					{/*<img src="/webpage.svg"/>*/}

		  					{/*<div className="exclamation exclamation-1">

		  						<Img fluid={localFiles.find(n => n.name == 'me-1').childImageSharp.fluid}/>

		  						<p>“This site is so easy to use — <strong>signing up</strong> was a no-brainer!”</p>

		  					</div>

		  					<div className="exclamation exclamation-2">

		  						<Img fluid={localFiles.find(n => n.name == 'me-2').childImageSharp.fluid}/>
		  						<p>“It was so <strong>easy to checkout here</strong>&hellip;I’m never using Amazon again!”</p>

		  					</div>

		  					<div className="exclamation exclamation-3">

		  						<Img fluid={localFiles.find(n => n.name == 'me-3').childImageSharp.fluid}/>
		  						<p>“This software really speaks to me&hellip;better sign up for that <strong>free trial!</strong>”</p>

		  					</div>*/}
		  				</div>

		  			</div>

	  			</div>

	  		</section>

	  		<section id="work-sample">

		  		<div className="container">

		  			<div className="row">

			  			<div className="col-12 sectionTitle">

			  				<h2>Featured Work</h2>
			  				<Link to="/portfolio" className="button">See All Work</Link>

			  			</div>

			  			{/*<Link to={'/portfolio/' + post.slug} className="image">{post.featuredImage ? <Img fluid={post.featuredImage.node.localFile.childImageSharp.fluid}/> : null }</Link>*/}

			  			{data.allWpPortfolio.nodes.map(post => (

				  			<div className="col-12 archive-portfolio active">

				  				<div className="wrap">

					  				
					  				<Link to={'/portfolio/' + post.slug} className="image">{post.featuredImage ? <BackgroundImage fluid={post.featuredImage.node.localFile.childImageSharp.fluid} className="bgImage"/> : null }</Link>

					  				<div className="rightSide">

					  					<div className="text">

					  						<Link to={'/portfolio/' + post.slug}><h3>{post.portfolioData.projectSimpleTitle}</h3></Link>
					  						<p className="meta">Cloud Computing</p>
					  						<p dangerouslySetInnerHTML={{ __html: post.portfolioData.projectSimpleDescription }}></p>

					  					</div>

					  					<Link to={'/portfolio/' + post.slug} className="button">Read More</Link>

					  				</div>

					  			</div>

				  			</div>

			  			))}

			  			</div>

							<div className="row">

								<div id="youtube-cta" className="col-12">
		  				
				  				<div className="leftContent">
				  					
				  					<h3>Watch me design <span className="accent">in real time.</span></h3>
				  					<p>Every week, I redesign popular product UIs LIVE on my YouTube channel, <em>Demystifying Design</em>.</p>

				  				</div>

				  				<div className="rightContent">
				  					
				  					<a target="_blank" className="button accent" rel="noopener" href="https://www.youtube.com/@demystifying-design">Live UI Design<svg style={{paddingBottom: '5px'}} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497.6,0,334.4.17A14.4,14.4,0,0,0,320,14.57V47.88a14.4,14.4,0,0,0,14.69,14.4l73.63-2.72,2.06,2.06L131.52,340.49a12,12,0,0,0,0,17l23,23a12,12,0,0,0,17,0L450.38,101.62l2.06,2.06-2.72,73.63A14.4,14.4,0,0,0,464.12,192h33.31a14.4,14.4,0,0,0,14.4-14.4L512,14.4A14.4,14.4,0,0,0,497.6,0ZM432,288H416a16,16,0,0,0-16,16V458a6,6,0,0,1-6,6H54a6,6,0,0,1-6-6V118a6,6,0,0,1,6-6H208a16,16,0,0,0,16-16V80a16,16,0,0,0-16-16H48A48,48,0,0,0,0,112V464a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V304A16,16,0,0,0,432,288Z"/></svg></a>

				  				</div>

				  			</div>

				  		</div>

			  		</div>

	  		</section>

  		</LayoutStandard>
  	)
}

export const query = graphql`query{
  allWpPortfolio(
    sort: {fields: [date], order: DESC}
    limit: 2
    filter: {portfolioData: {showOnHomepage: {eq: true}}}
  ) {
    nodes {
      content
      slug
      featuredImage {
        node {
          localFile {
            childImageSharp {
              fluid {
                ...GatsbyImageSharpFluid
              }
            }
          }
          id
        }
      }
      portfolioData {
        projectSimpleDescription
        projectSimpleTitle
        results
        showOnHomepage
      }
    }
  }
  allFile(filter: {absolutePath: {regex: "/(\/home)\//"  }}) {
    nodes {
      relativePath
      name
      childImageSharp {
        fluid(maxWidth: 40){
        	...GatsbyImageSharpFluid
        }
      }
    }
  }
}`
