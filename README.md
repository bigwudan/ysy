<?xml version="1.0" encoding="UTF-8"?>

<process name="demo" xmlns="http://jbpm.org/4.4/jpdl">
   <start g="160,16,48,48" name="start1">
      <transition g="-79,-22" name="to exclusive1" to="exclusive1"/>
   </start>
   <decision g="267,106,48,48" name="exclusive1">
   <handler class="\CommonClass\Order\WorkFlowHandle\HandleLeader" />
      <transition g="-52,-22" name="to leader" to="leader"/>
   </decision>
   <task candidate-users="#{leader}" g="114,129,92,52" name="leader">
      <transition g="-79,-22" name="to exclusive2" to="exclusive2"/>
	  <transition g="-79,-22" name="to cancel" to="cancel"/>
	  <transition g="-79,-22" name="to retreat" to="retreat"/>
   </task>
   <decision g="267,106,48,48" name="exclusive2">
   <handler class="\Org\Jbmp\TestHander\testHander" />
      <transition g="-52,-22" name="to chiefleader" to="chiefleader"/>
   </decision>
   <task candidate-users="#{chiefleader}" g="114,129,92,52" name="leader">
      <transition g="-79,-22" name="to exclusive3" to="exclusive3"/>
	  <transition g="-79,-22" name="to cancel" to="cancel"/>
	  <transition g="-79,-22" name="to retreat" to="retreat"/>
   </task>
   <decision g="267,106,48,48" name="exclusive3">
   <handler class="\Org\Jbmp\TestHander\testHander" />
      <transition g="-52,-22" name="to storehouse" to="storehouse"/>
   </decision>
   <task candidate-users="#{storehouse}" g="114,129,92,52" name="storehouse">
      <transition g="-79,-22" name="to complete" to="complete"/>
   </task>
   <state name="retreat">
		<transition g="-79,-22" name="to exclusive1" to="exclusive1"/>
		<transition g="-79,-22" name="to cancel" to="cancel"/>
   </state>
   <end name="complete" />
   <end name="cancel" /> 
</process>