USE [master]
GO
/****** Object:  Database [Session2]    Script Date: 8/23/2019 6:48:28 PM ******/
CREATE DATABASE [Session2]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'Session1', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\Session2.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'Session1_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\Session2_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
GO
ALTER DATABASE [Session2] SET COMPATIBILITY_LEVEL = 130
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [Session2].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [Session2] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [Session2] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [Session2] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [Session2] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [Session2] SET ARITHABORT OFF 
GO
ALTER DATABASE [Session2] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [Session2] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [Session2] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [Session2] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [Session2] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [Session2] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [Session2] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [Session2] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [Session2] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [Session2] SET  DISABLE_BROKER 
GO
ALTER DATABASE [Session2] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [Session2] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [Session2] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [Session2] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [Session2] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [Session2] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [Session2] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [Session2] SET RECOVERY FULL 
GO
ALTER DATABASE [Session2] SET  MULTI_USER 
GO
ALTER DATABASE [Session2] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [Session2] SET DB_CHAINING OFF 
GO
ALTER DATABASE [Session2] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [Session2] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [Session2] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [Session2] SET QUERY_STORE = OFF
GO
USE [Session2]
GO
/****** Object:  Table [dbo].[AssetGroups]    Script Date: 8/23/2019 6:48:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[AssetGroups](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_AssetTypes] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Assets]    Script Date: 8/23/2019 6:48:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Assets](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[AssetSN] [nvarchar](20) NOT NULL,
	[AssetName] [nvarchar](150) NOT NULL,
	[DepartmentLocationID] [bigint] NOT NULL,
	[EmployeeID] [bigint] NOT NULL,
	[AssetGroupID] [bigint] NOT NULL,
	[Description] [nvarchar](2000) NOT NULL,
	[WarrantyDate] [date] NULL,
 CONSTRAINT [PK_Assets] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ChangedParts]    Script Date: 8/23/2019 6:48:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ChangedParts](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[EmergencyMaintenanceID] [bigint] NOT NULL,
	[PartID] [bigint] NOT NULL,
	[Amount] [decimal](18, 2) NOT NULL,
 CONSTRAINT [PK_ChangedParts] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[DepartmentLocations]    Script Date: 8/23/2019 6:48:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DepartmentLocations](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[DepartmentID] [bigint] NOT NULL,
	[LocationID] [bigint] NOT NULL,
	[StartDate] [date] NOT NULL,
	[EndDate] [date] NULL,
 CONSTRAINT [PK_DepartmentLocations] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Departments]    Script Date: 8/23/2019 6:48:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Departments](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](100) NOT NULL,
 CONSTRAINT [PK_Departments] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[EmergencyMaintenances]    Script Date: 8/23/2019 6:48:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[EmergencyMaintenances](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[AssetID] [bigint] NOT NULL,
	[PriorityID] [bigint] NOT NULL,
	[DescriptionEmergency] [nvarchar](200) NOT NULL,
	[OtherConsiderations] [nvarchar](200) NOT NULL,
	[EMReportDate] [date] NOT NULL,
	[EMStartDate] [date] NULL,
	[EMEndDate] [date] NULL,
	[EMTechnicianNote] [nvarchar](200) NULL,
 CONSTRAINT [PK_EMS] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Employees]    Script Date: 8/23/2019 6:48:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Employees](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[FirstName] [nvarchar](50) NOT NULL,
	[LastName] [nvarchar](50) NOT NULL,
	[Phone] [nvarchar](50) NOT NULL,
	[isAdmin] [bit] NULL,
	[Username] [nvarchar](50) NULL,
	[Password] [nvarchar](50) NULL,
 CONSTRAINT [PK_Employees] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Locations]    Script Date: 8/23/2019 6:48:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Locations](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](100) NOT NULL,
 CONSTRAINT [PK_Locations] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Parts]    Script Date: 8/23/2019 6:48:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Parts](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](50) NOT NULL,
	[EffectiveLife] [bigint] NULL,
 CONSTRAINT [PK_Parts] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Priorities]    Script Date: 8/23/2019 6:48:28 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Priorities](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](50) NOT NULL,
 CONSTRAINT [PK_Priorities] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[AssetGroups] ON 

INSERT [dbo].[AssetGroups] ([ID], [Name]) VALUES (1, N'Hydraulic')
INSERT [dbo].[AssetGroups] ([ID], [Name]) VALUES (2, N'Pneumatic')
INSERT [dbo].[AssetGroups] ([ID], [Name]) VALUES (3, N'Electrical')
INSERT [dbo].[AssetGroups] ([ID], [Name]) VALUES (4, N'Mechanical ')
INSERT [dbo].[AssetGroups] ([ID], [Name]) VALUES (5, N'Fixed/Stationary')
INSERT [dbo].[AssetGroups] ([ID], [Name]) VALUES (6, N'Facility')
INSERT [dbo].[AssetGroups] ([ID], [Name]) VALUES (7, N'Buildings')
SET IDENTITY_INSERT [dbo].[AssetGroups] OFF
SET IDENTITY_INSERT [dbo].[Assets] ON 

INSERT [dbo].[Assets] ([ID], [AssetSN], [AssetName], [DepartmentLocationID], [EmployeeID], [AssetGroupID], [Description], [WarrantyDate]) VALUES (1, N'05/04/0001', N'Toyota Hilux FAF321', 3, 8, 4, N'', NULL)
INSERT [dbo].[Assets] ([ID], [AssetSN], [AssetName], [DepartmentLocationID], [EmployeeID], [AssetGroupID], [Description], [WarrantyDate]) VALUES (2, N'04/03/0001', N'Suction Line 852', 7, 8, 3, N'', CAST(N'2020-03-02' AS Date))
INSERT [dbo].[Assets] ([ID], [AssetSN], [AssetName], [DepartmentLocationID], [EmployeeID], [AssetGroupID], [Description], [WarrantyDate]) VALUES (3, N'01/01/0001', N'ZENY 3,5CFM Single-Stage 5 Pa Rotary Vane', 11, 1, 1, N'', CAST(N'2018-01-17' AS Date))
INSERT [dbo].[Assets] ([ID], [AssetSN], [AssetName], [DepartmentLocationID], [EmployeeID], [AssetGroupID], [Description], [WarrantyDate]) VALUES (4, N'05/04/0002', N'Volvo FH16', 4, 8, 4, N'', NULL)
SET IDENTITY_INSERT [dbo].[Assets] OFF
SET IDENTITY_INSERT [dbo].[ChangedParts] ON 

INSERT [dbo].[ChangedParts] ([ID], [EmergencyMaintenanceID], [PartID], [Amount]) VALUES (1, 3, 5, CAST(1.00 AS Decimal(18, 2)))
INSERT [dbo].[ChangedParts] ([ID], [EmergencyMaintenanceID], [PartID], [Amount]) VALUES (2, 1, 1, CAST(1.00 AS Decimal(18, 2)))
SET IDENTITY_INSERT [dbo].[ChangedParts] OFF
SET IDENTITY_INSERT [dbo].[DepartmentLocations] ON 

INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (1, 6, 3, CAST(N'2010-12-28' AS Date), CAST(N'2011-01-20' AS Date))
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (2, 6, 2, CAST(N'2015-12-27' AS Date), CAST(N'2019-08-20' AS Date))
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (3, 5, 2, CAST(N'1996-04-29' AS Date), NULL)
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (4, 5, 1, CAST(N'2002-03-04' AS Date), NULL)
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (5, 5, 1, CAST(N'1991-03-25' AS Date), CAST(N'2001-10-30' AS Date))
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (6, 4, 3, CAST(N'2012-05-28' AS Date), NULL)
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (7, 4, 2, CAST(N'2005-05-04' AS Date), NULL)
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (8, 3, 2, CAST(N'1992-10-17' AS Date), NULL)
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (9, 3, 3, CAST(N'2000-01-08' AS Date), NULL)
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (10, 2, 1, CAST(N'1993-12-25' AS Date), NULL)
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (11, 1, 2, CAST(N'2005-11-11' AS Date), NULL)
INSERT [dbo].[DepartmentLocations] ([ID], [DepartmentID], [LocationID], [StartDate], [EndDate]) VALUES (12, 1, 2, CAST(N'1991-01-17' AS Date), CAST(N'2000-02-02' AS Date))
SET IDENTITY_INSERT [dbo].[DepartmentLocations] OFF
SET IDENTITY_INSERT [dbo].[Departments] ON 

INSERT [dbo].[Departments] ([ID], [Name]) VALUES (1, N'Exploration')
INSERT [dbo].[Departments] ([ID], [Name]) VALUES (2, N'Production')
INSERT [dbo].[Departments] ([ID], [Name]) VALUES (3, N'Transportation')
INSERT [dbo].[Departments] ([ID], [Name]) VALUES (4, N'R&D')
INSERT [dbo].[Departments] ([ID], [Name]) VALUES (5, N'Distribution')
INSERT [dbo].[Departments] ([ID], [Name]) VALUES (6, N'QHSE')
SET IDENTITY_INSERT [dbo].[Departments] OFF
SET IDENTITY_INSERT [dbo].[EmergencyMaintenances] ON 

INSERT [dbo].[EmergencyMaintenances] ([ID], [AssetID], [PriorityID], [DescriptionEmergency], [OtherConsiderations], [EMReportDate], [EMStartDate], [EMEndDate], [EMTechnicianNote]) VALUES (1, 1, 2, N'Car does not start', N'none', CAST(N'2019-08-27' AS Date), CAST(N'2019-08-27' AS Date), NULL, NULL)
INSERT [dbo].[EmergencyMaintenances] ([ID], [AssetID], [PriorityID], [DescriptionEmergency], [OtherConsiderations], [EMReportDate], [EMStartDate], [EMEndDate], [EMTechnicianNote]) VALUES (2, 4, 1, N'Perforated tire', N'none', CAST(N'2019-08-27' AS Date), CAST(N'2019-08-27' AS Date), NULL, NULL)
INSERT [dbo].[EmergencyMaintenances] ([ID], [AssetID], [PriorityID], [DescriptionEmergency], [OtherConsiderations], [EMReportDate], [EMStartDate], [EMEndDate], [EMTechnicianNote]) VALUES (3, 4, 1, N'Preforated tire', N'none', CAST(N'2017-09-29' AS Date), CAST(N'2017-09-29' AS Date), CAST(N'2017-09-29' AS Date), N'The tire changed')
SET IDENTITY_INSERT [dbo].[EmergencyMaintenances] OFF
SET IDENTITY_INSERT [dbo].[Employees] ON 

INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (1, N'Martina', N'Winegarden', N'69232044381', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (2, N'Rashida', N'Brammer', N'70687629632', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (3, N'Mohamed', N'Krall', N'52688435003', NULL, N'mohamed', N'1234')
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (4, N'Shante', N'Karr', N'73706803851', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (5, N'Rosaura', N'Rames', N'70477806324', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (6, N'Toi', N'Courchesne', N'37756763508', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (7, N'Precious', N'Wismer', N'15287468908', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (8, N'Josefa', N'Otte', N'68886927765', NULL, N'josefa', N'1324')
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (9, N'Afton', N'Harrington', N'41731972558', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (10, N'Daphne', N'Morrow', N'49099375842', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (11, N'Dottie', N'Polson', N'91205317719', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (12, N'Alleen', N'Nally', N'26312971918', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (13, N'Hilton', N'Odom', N'66197770749', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (14, N'Shawn', N'Hillebrand', N'64091780262', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (15, N'Lorelei', N'Kettler', N'73606665126', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (16, N'Jalisa', N'Gossage', N'10484197749', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (17, N'Germaine', N'Sim', N'62454794026', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (18, N'Suzanna', N'Wollman', N'97932678482', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (19, N'Jennette', N'Besse', N'26229712670', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (20, N'Margherita', N'Anstine', N'87423893204', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (21, N'Earleen', N'Lambright', N'64658700776', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (22, N'Lyn', N'Valdivia', N'32010885662', 1, N'lyn', N'1234')
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (23, N'Alycia', N'Couey', N'41716866650', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (24, N'Lewis', N'Rousey', N'16716397946', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (25, N'Tanja', N'Profitt', N'77230010211', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (26, N'Cherie', N'Whyte', N'33510813739', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (27, N'Efren', N'Leaf', N'72090665294', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (28, N'Delta', N'Darcangelo', N'73136120450', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (29, N'Jess', N'Bodnar', N'12207277240', NULL, NULL, NULL)
INSERT [dbo].[Employees] ([ID], [FirstName], [LastName], [Phone], [isAdmin], [Username], [Password]) VALUES (30, N'Sudie', N'Parkhurst', N'26842289705', NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[Employees] OFF
SET IDENTITY_INSERT [dbo].[Locations] ON 

INSERT [dbo].[Locations] ([ID], [Name]) VALUES (1, N'Kazan')
INSERT [dbo].[Locations] ([ID], [Name]) VALUES (2, N'Volka')
INSERT [dbo].[Locations] ([ID], [Name]) VALUES (3, N'Moscow')
SET IDENTITY_INSERT [dbo].[Locations] OFF
SET IDENTITY_INSERT [dbo].[Parts] ON 

INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (1, N'BLUE STORM Battery 12V 45Ah 54459', 650)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (2, N'BLUE STORM Battery 12V 70Ah 80D26L', 700)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (3, N'CT20 Turbo Turbocharger', NULL)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (5, N'michelin tyres   525/60 ZR 20.5', 1000)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (6, N'MOCA Engine Timing Chain Kit ', NULL)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (7, N'CT16V Turbo Cartridge Core', NULL)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (8, N'iFJF 21100-35520 New Carburetor', NULL)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (9, N'ALAVENTE 21100-35463 Carburetor ', NULL)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (11, N'Carter P4594 In-Line Electric Fuel Pump', NULL)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (12, N'Electric Fuel Pump Universal Fuel Pump 12V ', NULL)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (13, N'Gast AT05 Rotary Vane ', NULL)
INSERT [dbo].[Parts] ([ID], [Name], [EffectiveLife]) VALUES (14, N'FAN 24" M480', 200)
SET IDENTITY_INSERT [dbo].[Parts] OFF
SET IDENTITY_INSERT [dbo].[Priorities] ON 

INSERT [dbo].[Priorities] ([ID], [Name]) VALUES (1, N'General')
INSERT [dbo].[Priorities] ([ID], [Name]) VALUES (2, N'High')
INSERT [dbo].[Priorities] ([ID], [Name]) VALUES (3, N'Very High')
SET IDENTITY_INSERT [dbo].[Priorities] OFF
ALTER TABLE [dbo].[Assets]  WITH CHECK ADD  CONSTRAINT [FK_Assets_AssetGroups] FOREIGN KEY([AssetGroupID])
REFERENCES [dbo].[AssetGroups] ([ID])
GO
ALTER TABLE [dbo].[Assets] CHECK CONSTRAINT [FK_Assets_AssetGroups]
GO
ALTER TABLE [dbo].[Assets]  WITH CHECK ADD  CONSTRAINT [FK_Assets_DepartmentLocations] FOREIGN KEY([DepartmentLocationID])
REFERENCES [dbo].[DepartmentLocations] ([ID])
GO
ALTER TABLE [dbo].[Assets] CHECK CONSTRAINT [FK_Assets_DepartmentLocations]
GO
ALTER TABLE [dbo].[Assets]  WITH CHECK ADD  CONSTRAINT [FK_Assets_Employees] FOREIGN KEY([EmployeeID])
REFERENCES [dbo].[Employees] ([ID])
GO
ALTER TABLE [dbo].[Assets] CHECK CONSTRAINT [FK_Assets_Employees]
GO
ALTER TABLE [dbo].[ChangedParts]  WITH CHECK ADD  CONSTRAINT [FK_ChangedParts_EmergencyMaintenances] FOREIGN KEY([EmergencyMaintenanceID])
REFERENCES [dbo].[EmergencyMaintenances] ([ID])
GO
ALTER TABLE [dbo].[ChangedParts] CHECK CONSTRAINT [FK_ChangedParts_EmergencyMaintenances]
GO
ALTER TABLE [dbo].[ChangedParts]  WITH CHECK ADD  CONSTRAINT [FK_ChangedParts_Parts] FOREIGN KEY([PartID])
REFERENCES [dbo].[Parts] ([ID])
GO
ALTER TABLE [dbo].[ChangedParts] CHECK CONSTRAINT [FK_ChangedParts_Parts]
GO
ALTER TABLE [dbo].[DepartmentLocations]  WITH CHECK ADD  CONSTRAINT [FK_DepartmentLocations_Departments] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Departments] ([ID])
GO
ALTER TABLE [dbo].[DepartmentLocations] CHECK CONSTRAINT [FK_DepartmentLocations_Departments]
GO
ALTER TABLE [dbo].[DepartmentLocations]  WITH CHECK ADD  CONSTRAINT [FK_DepartmentLocations_Locations] FOREIGN KEY([LocationID])
REFERENCES [dbo].[Locations] ([ID])
GO
ALTER TABLE [dbo].[DepartmentLocations] CHECK CONSTRAINT [FK_DepartmentLocations_Locations]
GO
ALTER TABLE [dbo].[EmergencyMaintenances]  WITH CHECK ADD  CONSTRAINT [FK_EmergencyMaintenances_Assets] FOREIGN KEY([AssetID])
REFERENCES [dbo].[Assets] ([ID])
GO
ALTER TABLE [dbo].[EmergencyMaintenances] CHECK CONSTRAINT [FK_EmergencyMaintenances_Assets]
GO
ALTER TABLE [dbo].[EmergencyMaintenances]  WITH CHECK ADD  CONSTRAINT [FK_EmergencyMaintenances_Priorities] FOREIGN KEY([PriorityID])
REFERENCES [dbo].[Priorities] ([ID])
GO
ALTER TABLE [dbo].[EmergencyMaintenances] CHECK CONSTRAINT [FK_EmergencyMaintenances_Priorities]
GO
USE [master]
GO
ALTER DATABASE [Session2] SET  READ_WRITE 
GO
